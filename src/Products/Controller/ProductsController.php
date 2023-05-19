<?php

namespace App\Products\Controller;

use App\Products\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        return $this->render('products/catalog.html.twig', [
            'products' => $this->productRepository->DANGEROUSLY_getAllProducts(),
        ]);
    }
}