<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/users')]
class MeController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route('/me', name: 'app_me')]
    public function index(): Response
    {
        return $this->render('users/me/index.html.twig');
    }

    #[Route('/me/edit', name: 'app_me_edit')]
    public function edit(): Response
    {
        return $this->render('users/me/edit.html.twig');
    }

    #[Route('/me/logout', name: 'app_me_logout')]
    public function logout(): Response
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}