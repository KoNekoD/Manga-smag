<?php

namespace App\Products\Controller;

use App\Products\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $productRepository
    )
    {
    }

    #[Route('/product/view/{id}', name: 'app_product_view')]
    public function view(int $id): Response
    {
        return $this->render('products/view.html.twig', [
            'product' => $this->productRepository->find($id),
        ]);
    }

    #[Route('/product/catalog', name: 'app_product_catalog')]
    public function catalog(): Response
    {
        return $this->render('products/list.html.twig', [
            'products' => $this->productRepository->DANGEROUSLY_getAllProducts(),
        ]);
    }

    #[Route('/product/search', name: 'app_product_search', methods: ['GET'])]
    public function search(Request $request): Response
    {
        $search = $request->query->get('search', '');

        if (strlen($search) > 3) {
            $products = $this->productRepository->findByLikeName($search);
            if (count($products) === 0) {
                $this->addFlash('error', 'Ничего не найдено');
            }
        } else {
            $this->addFlash('error', 'Поиск должен быть длиннее 3 символов!');
            $products = [];
        }

        return $this->render('products/list.html.twig', [
            'products' => $products,
        ]);
    }
}