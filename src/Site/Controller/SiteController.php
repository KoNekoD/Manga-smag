<?php

namespace App\Site\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {
        return  $this->render('site/index.html.twig');
    }

    #[Route('/contact')]
    public function contact(): Response
    {
        return  $this->render('site/contact.html.twig');
    }

    #[Route('/delivery')]
    public function delivery(): Response
    {
        return  $this->render('site/delivery.html.twig');
    }

    #[Route('/news')]
    public function news(): Response
    {
        return  $this->render('site/news.html.twig');
    }

    #[Route('/refund')]
    public function refund(): Response
    {
        return  $this->render('site/refund.html.twig');
    }
}