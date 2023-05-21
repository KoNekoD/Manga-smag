<?php

declare(strict_types=1);

namespace App\Users\Controller;

use App\Shared\Security\UserFetcherInterface;
use App\Shared\Service\SerializerServiceInterface;
use App\Users\DTO\UserEditDTO;
use App\Users\Entity\User;
use App\Users\Repository\UserRepository;
use App\Users\Service\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/users')]
class MeController extends AbstractController
{
    public function __construct(
        private readonly UserRepository             $userRepository,
        private readonly UserFetcherInterface       $userFetcher,
        private readonly SerializerServiceInterface $serializerService,
        private readonly ValidatorInterface         $validator
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

    #[Route('/me/edit', name: 'app_me_edit', methods: ['GET'])]
    public function edit(
        Request                     $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface      $entityManager
    ): Response
    {
        /** @var User $user */
        $user = $this->userRepository->find(
            $this->userFetcher->getAuthUser()->getId()
        );

        /** @var UserEditDTO $dto */
        $dto = $this->serializerService->denormalize($request->request->all(), UserEditDTO::class);

        $validationErrors = $this->validator->validate($dto);

        $errors = [];
        if ($validationErrors->count() > 0) {
            foreach ($validationErrors as $error) {
                $errors[] = $error->getPropertyPath() . ' ' . $error->getMessage();
            }
        } else {
            // Update user
            $user->updateInformation($dto);
            if (!empty($dto->newPassword)) {
                $user->setPassword($dto->newPassword, $passwordHasher);
            }
            $entityManager->flush();
        }

        return $this->render('users/me/edit.html.twig', [
            'errors' => $errors,
            'user' => $user
        ]);
    }
}