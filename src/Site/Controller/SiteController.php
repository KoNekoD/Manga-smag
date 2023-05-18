<?php

namespace App\Site\Controller;


use App\Products\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    public function __construct(
        private readonly ProductRepository $productRepository
    )
    {
    }

    #[Route('/', name: 'app_site_index')]
    public function index(): Response
    {
        return $this->render('site/index.html.twig', [
            'latestProducts' => $this->productRepository->getLatestProducts(),
        ]);
    }

    #[Route('/contact', name: 'app_site_contact')]
    public function contact(): Response
    {
        $errors = [];
        $done = false;

        // @TODO Сделать

        return $this->render('site/contact.html.twig', [
            'done' => $done,
            'errors' => $errors,
        ]);
    }

    #[Route('/delivery', name: 'app_site_delivery')]
    public function delivery(): Response
    {
        return  $this->render('site/delivery.html.twig');
    }

    #[Route('/news', name: 'app_site_news')]
    public function news(): Response
    {
        return  $this->render('site/news.html.twig');
    }

    #[Route('/refund', name: 'app_site_refund')]
    public function refund(): Response
    {
        return  $this->render('site/refund.html.twig');
    }
}