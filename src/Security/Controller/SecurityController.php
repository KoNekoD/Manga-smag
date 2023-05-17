<?php

declare(strict_types=1);

namespace App\Security\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends AbstractController
{
    public function register(): Response
    {
        return $this->render('security/register.html.twig');
    }

    # @see https://symfony.com/doc/current/security.html#form-login
    public function login(): Response
    {
        return $this->render('security/login.html.twig');
    }
}