<?php

namespace App\Users\Controller;

use App\Products\Entity\Order;
use App\Products\Repository\OrderRepository;
use App\Products\Repository\ProductRepository;
use App\Shared\Service\SerializerServiceInterface;
use App\Users\DTO\OrderUpdateDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/users')]
class AdminOrderController extends AbstractController
{
    public function __construct(
        private readonly OrderRepository   $orderRepository,
        private readonly ProductRepository $productRepository,
        private readonly SerializerServiceInterface $serializerService,
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    #[Route('/admin/order', name: 'app_admin_order_index')]
    public function index(): Response
    {
        return $this->render('users/admin_order/index.html.twig', [
            'ordersList' => $this->orderRepository->findAll()
        ]);
    }

    #[Route('/admin/order/update/{id}', name: 'app_admin_order_update')]
    public function update(int $id, Request $request): Response
    {
        /** @var Order $order */
        $order = $this->orderRepository->find($id);

        if ($request->getContent()) {
            /** @var OrderUpdateDTO $dto */
            $dto = $this->serializerService->denormalize($request->request->all(), OrderUpdateDTO::class);
            $order->updateInformation($dto);
            $this->entityManager->flush();
        }

        return $this->render('users/admin_order/update.html.twig', [
            'order' => $order
        ]);
    }

    #[Route('/admin/order/delete/{id}', name: 'app_admin_order_delete')]
    public function delete(int $id, Request $request): Response
    {
        if ($request->request->get('accept')) {
            /** @var Order $order */
            $order = $this->orderRepository->find($id);
            $this->entityManager->remove($order);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_admin_order_index');
        }
        return $this->render('users/admin_order/delete.html.twig', [
            'order' => $this->orderRepository->find($id)
        ]);
    }

    #[Route('/admin/order/view/{id}', name: 'app_admin_order_view')]
    public function view(int $id): Response
    {
        $order = $this->orderRepository->find($id);
        return $this->render('users/admin_order/view.html.twig', [
            'order' => $order,
            'orderProducts' => $this->productRepository->findByIds(
                $order->getProductsIds()
            )
        ]);
    }

}
