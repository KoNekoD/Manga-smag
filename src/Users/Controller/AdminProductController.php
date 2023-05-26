<?php

namespace App\Users\Controller;

use App\Products\Entity\Product;
use App\Products\Repository\ProductRepository;
use App\Shared\Service\SerializerServiceInterface;
use App\Users\DTO\ProductCreateDTO;
use App\Users\DTO\ProductUpdateDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/users')]
class AdminProductController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository          $productRepository,
        private readonly SerializerServiceInterface $serializerService,
        private readonly EntityManagerInterface     $entityManager,
        private readonly SluggerInterface           $slugger
    )
    {
    }

    #[Route('/admin/product', name: 'app_admin_product_index')]
    public function index(): Response
    {
        return $this->render('users/admin_product/index.html.twig', [
            'products' => $this->productRepository->findAll()
        ]);
    }

    #[Route('/admin/product/create', name: 'app_admin_product_create')]
    public function create(Request $request): Response
    {
        if ($request->request->get('submit')) {
            /** @var ProductUpdateDTO $dto */
            $dto = $this->serializerService->denormalize($request->request->all(), ProductCreateDTO::class);

            // Can be moved to factory:
            $product = new Product(
                name: $dto->name,
                code: (int)$dto->code,
                price: (float)$dto->price,
                description: $dto->description,
            );

            $imageFile = $request->files->get('image');
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $this->slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('product_images_directory_full_path'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw $e;
                }

                $product->setImage(
                    $this->getParameter('product_images_directory_path') . $newFilename
                );
            }

            $this->entityManager->persist($product);

            $this->entityManager->flush();

            return $this->redirectToRoute('app_admin_product_index');
        }

        $errors = [];
        return $this->render('users/admin_product/create.html.twig', [
            'errors' => $errors
        ]);
    }

    #[Route('/admin/product/update/{id}', name: 'app_admin_product_update')]
    public function update(int $id, Request $request): Response
    {
        /** @var Product $product */
        $product = $this->productRepository->find($id);

        if ($request->request->get('submit')) {
            /** @var ProductUpdateDTO $dto */
            $dto = $this->serializerService->denormalize($request->request->all(), ProductUpdateDTO::class);
            $product->updateInformation($dto);

            $imageFile = $request->files->get('image');
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $this->slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('product_images_directory_full_path'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw $e;
                }

                $product->setImage(
                    $this->getParameter('product_images_directory_path') . $newFilename
                );
            }
            $this->entityManager->flush();
            return $this->redirectToRoute('app_admin_product_index');
        }

        return $this->render('users/admin_product/update.html.twig', [
            'product' => $product
        ]);
    }

    #[Route('/admin/product/delete/{id}', name: 'app_admin_product_delete')]
    public function delete(int $id, Request $request): Response
    {
        /** @var Product $product */
        $product = $this->productRepository->find($id);
        if ($request->request->get('accept')) {
            $this->entityManager->remove($product);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_admin_product_index');
        }

        return $this->render('users/admin_product/delete.html.twig', [
            'product' => $product
        ]);
    }
}