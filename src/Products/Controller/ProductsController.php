<?php

namespace App\Products\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/product/{id}')]
    public function view(int $id): Response
    {
        return $this->render('product/view.html.twig');
    }

    #[Route('/product/catalog')]
    public function catalog(): Response
    {
        return $this->render('catalog/index.html.twig');
    }
}