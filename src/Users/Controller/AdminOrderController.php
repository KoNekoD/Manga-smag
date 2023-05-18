<?php

namespace App\Users\Controller;

use App\Products\Repository\OrderRepository;
use App\Products\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/users')]
class AdminOrderController extends AbstractController
{
    public function __construct(
        private readonly OrderRepository   $orderRepository,
        private readonly ProductRepository $productRepository,
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
    public function update(int $id): Response
    {
        return $this->render('users/admin_order/update.html.twig', [
            'order' => $this->orderRepository->find($id)
        ]);
    }

    #[Route('/admin/order/delete/{id}', name: 'app_admin_order_delete')]
    public function delete(int $id): Response
    {
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
