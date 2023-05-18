<?php

namespace App\Products\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/product/{id}', name: 'app_product_view')]
    public function view(int $id): Response
    {
        return $this->render('products/view.html.twig');
    }

    #[Route('/product/catalog', name: 'app_product_catalog')]
    public function catalog(): Response
    {
        return $this->render('products/catalog.html.twig');
    }
}