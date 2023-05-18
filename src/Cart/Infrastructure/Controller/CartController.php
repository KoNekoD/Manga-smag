<?php

declare(strict_types=1);

namespace App\Cart\Infrastructure\Controller;

use App\Cart\Infrastructure\DTO\CartCheckoutDTO;
use App\Cart\Infrastructure\Service\CartService;
use App\Orders\Domain\Entity\Order;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Shared\Domain\Service\SerializerServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/cart')]
class CartController extends AbstractController
{
    public function __construct(
        private readonly CartService                $cartService,
        private readonly UserFetcherInterface       $userFetcher,
        private readonly SerializerServiceInterface $serializerService,
        private readonly ValidatorInterface         $validator,
        private readonly EntityManagerInterface     $entityManager
    )
    {
    }

    #[Route('/', name: 'app_cart_index')]
    public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $this->cartService->getCartAndRefreshData()
        ]);
    }

    #[Route('/checkout', name: 'app_cart_checkout')]
    public function checkout(Request $request): Response
    {
        $cart = $this->cartService->getCartAndRefreshData();

        if (empty($cart->products)) {
            // @TODO app_site_index does not exist
            return $this->redirectToRoute('app_site_index');
        }

        $user = null;
        $checkoutDTO = new CartCheckoutDTO();
        if ($this->isGranted('ROLE_USER')) {
            $user = $this->userFetcher->getAuthUser();
            $checkoutDTO->userName = $user->getEmail();
        }


        $errors = [];
        $done = false;
        if ($request->getContent()) {
            /** @var CartCheckoutDTO $checkoutDTO */
            $checkoutDTO = $this->serializerService->denormalize($request->request->all(), CartCheckoutDTO::class);

            $errors = $this->validator->validate($checkoutDTO);

            if (0 === $errors->count()) {
                $order = new Order(
                    $checkoutDTO->userName,
                    $checkoutDTO->userPhone,
                    $checkoutDTO->userComment,
                    $user?->getId(),
                    $cart->getProductsIds()
                );

                $this->entityManager->persist($order);
                $this->entityManager->flush();

                $this->cartService->clearCart();

                // Тут можно внедрить отправку E-Mail

                $done = true;
            }
        }

        return $this->render('cart/checkout.html.twig', [
            'cart' => $cart,
            'checkout' => $checkoutDTO,
            'errors' => $errors,
            'done' => $done
        ]);
    }

    #[Route('/add/ajax/{id}', name: 'app_cart_add_ajax')]
    public function addAjax(int $id): Response
    {
        $this->cartService->addOneProduct($id);

        return new Response(status: Response::HTTP_NO_CONTENT);
    }

    #[Route('/remove/ajax/{id}', name: 'app_cart_remove_ajax')]
    public function removeAjax(int $id): Response
    {
        $this->cartService->removeOneProduct($id);

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}