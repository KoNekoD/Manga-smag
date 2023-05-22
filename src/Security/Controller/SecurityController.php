<?php

declare(strict_types=1);

namespace App\Security\Controller;

use App\Security\DTO\RegistrationDataStructure;
use App\Shared\Service\SerializerServiceInterface;
use App\Users\Service\CreateUserService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SecurityController extends AbstractController
{
    public function __construct(
        private readonly SerializerServiceInterface $serializerService,
        private readonly ValidatorInterface         $validator,
        private readonly FormLoginAuthenticator     $authenticator,
        private readonly CreateUserService          $createUserService,

    )
    {
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserAuthenticatorInterface $authenticatorManager): Response
    {
        if ($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_me');
        }

        $errors = [];
        if ($request->getContent()) {
            $dto = $this->serializerService->denormalize($request->request->all(), RegistrationDataStructure::class);
            $validationErrors = $this->validator->validate($dto);

            if ($validationErrors->count() > 0) {
                foreach ($validationErrors as $error) {
                    $errors[] = $error->getPropertyPath() . ' ' . $error->getMessage();
                }
            } else {
                $result = $this->createUserService->create(
                    $dto->name,
                    $dto->email,
                    $dto->password
                );
                $authenticatorManager->authenticateUser(
                    $result,
                    $this->authenticator,
                    $request,
                    [new RememberMeBadge()]
                );
                return $this->redirectToRoute('app_site_index');
            }

        }

        return $this->render('security/register.html.twig', ['errors' => $errors]);
    }

    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_me');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): Response
    {
        // controller can be blank: it will never be called!
        throw new Exception('Don\'t forget to activate logout in security.yaml');
    }
}