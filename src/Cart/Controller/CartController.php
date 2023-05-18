<?php

declare(strict_types=1);

namespace App\Cart\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route('/', name: 'app_cart_index')]
    public function index(): Response
    {
        return $this->render('cart/index.html.twig');
    }

    #[Route('/checkout', name: 'app_cart_checkout')]
    public function checkout(): Response
    {
        return $this->render('cart/checkout.html.twig');
    }

    #[Route('/add/ajax/{id}', name: 'app_cart_add_ajax')]
    public function addAjax(int $id): Response
    {
        // @TODO
        return new JsonResponse([]);
    }

    #[Route('/remove/ajax/{id}', name: 'app_cart_remove_ajax')]
    public function removeAjax(int $id): Response
    {
        // @TODO
        return new JsonResponse([]);
    }
}