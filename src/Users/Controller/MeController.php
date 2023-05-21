<?php

declare(strict_types=1);

namespace App\Users\Controller;

use App\Shared\Security\UserFetcherInterface;
use App\Users\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/users')]
class MeController extends AbstractController
{
    public function __construct(
        private readonly UserRepository       $userRepository,
        private readonly UserFetcherInterface $userFetcher,
    )
    {
    }

    #[Route('/me', name: 'app_me')]
    public function index(): Response
    {
        return $this->render('users/me/index.html.twig', [
            'user' => $this->userRepository->find(
                $this->userFetcher->getAuthUser()->getId()
            ),
        ]);
    }

    #[Route('/me/edit', name: 'app_me_edit')]
    public function edit(): Response
    {
        $errors = [];
        return $this->render('users/me/edit.html.twig', [
            'errors' => $errors,
            'user' => $this->userRepository->find(
                $this->userFetcher->getAuthUser()->getId()
            )
        ]);
    }
}