<?php

namespace App\Users\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/users')]
class AdminProductController extends AbstractController
{

    #[Route('/admin/product', name: 'app_admin_product_index')]
    public function index(): Response
    {
        return $this->render('users/admin_product/index.html.twig');
    }

    #[Route('/admin/product/create', name: 'app_admin_product_create')]
    public function create(): Response
    {
        return $this->render('users/admin_product/create.html.twig');
    }

    #[Route('/admin/product/update/{id}', name: 'app_admin_product_update')]
    public function update(int $id): Response
    {
        return $this->render('users/admin_product/update.html.twig');
    }

    #[Route('/admin/product/delete/{id}', name: 'app_admin_product_delete')]
    public function delete(int $id): Response
    {
        return $this->render('users/admin_product/delete.html.twig');
    }

}