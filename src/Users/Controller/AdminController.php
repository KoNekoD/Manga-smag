<?php

declare(strict_types=1);

namespace App\Users\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/users')]
class AdminController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route('/admin', name: 'app_admin_index')]
    public function index(): Response
    {
        return $this->render('users/admin/index.html.twig');
    }
}