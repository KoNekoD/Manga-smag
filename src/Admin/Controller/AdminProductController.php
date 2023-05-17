<?php

namespace App\Admin\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
{

    #[Route('/admin/product')]
    public function index(): Response
    {
        return $this->render('admin_product/index.html.twig');
    }

    #[Route('/admin/product/create')]
    public function create(): Response
    {
        return $this->render('admin_product/create.html.twig');
    }

    #[Route('/admin/product/update/{id}')]
    public function update(int $id): Response
    {
        return $this->render('admin_product/update.html.twig');
    }

    #[Route('/admin/product/delete/{id}')]
    public function delete(int $id): Response
    {
        return $this->render('admin_product/delete.html.twig');
    }

}