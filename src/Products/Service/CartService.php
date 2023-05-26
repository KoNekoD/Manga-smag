<?php

declare(strict_types=1);

namespace App\Products\Service;

use App\Products\DTO\CartDTO;
use App\Products\DTO\CartProductDTO;
use App\Products\Repository\ProductRepository;
use App\Shared\Service\SerializerServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    public function __construct(
        private readonly RequestStack               $requestStack,
        private readonly ProductRepository          $productRepository,
        private readonly SerializerServiceInterface $serializerService,
    )
    {
    }

    public function clearCart(): void
    {
        $session = $this->requestStack->getSession();
        $session->set('cart', $this->serializerService->serialize(new CartDTO()));
        $session->set('cart-products-count', 0);
    }

    public function getCartAndRefreshData(): CartDTO
    {
        $session = $this->requestStack->getSession();
        $storedCart = $this->createOrGetSessionCart($session);

        if (!empty($storedCart->products)) {
            $ids = $storedCart->getProductsIds();
            $products = $this->productRepository->findByIds($ids);

            foreach ($ids as $id) {
                foreach ($products as $product) {
                    if ($product->getId() === $id) {
                        $storedCart->updateProductPrice($product);
                    }
                }
            }
            $session->set('cart', $this->serializerService->serialize($storedCart));
            $session->set('cart-products-count', $storedCart->getTotalCount());
        }

        return $storedCart;
    }

    private function createOrGetSessionCart(SessionInterface $session): CartDTO
    {
        if (null === $session->get('cart')) {
            $storedCart = new CartDTO();
            $session->set('cart', $this->serializerService->serialize($storedCart));
            $session->set('cart-products-count', 0);
        } else {
            $storedCart = $this->serializerService->deserialize(
                $session->get('cart'),
                CartDTO::class
            );
        }

        return $storedCart;
    }

    public function addOneProduct(int $id): void
    {
        $session = $this->requestStack->getSession();
        $storedCart = $this->createOrGetSessionCart($session);

        $product = $this->productRepository->findById($id);

        $storedCart->addProduct(
            new CartProductDTO(
                $id,
                1,
                $product->getPrice(),
                $product->getImage(),
                $product->getName(),
            )
        );
        $session->set('cart', $this->serializerService->serialize($storedCart));
        $session->set('cart-products-count', $storedCart->getTotalCount());
    }

    public function removeOneProduct(int $id): void
    {
        $session = $this->requestStack->getSession();
        $storedCart = $this->createOrGetSessionCart($session);

        $storedCart->removeProduct($id);
        $session->set('cart', $this->serializerService->serialize($storedCart));
        $session->set('cart-products-count', $storedCart->getTotalCount());
    }

    public function removeProductPosition(int $id): void
    {
        $session = $this->requestStack->getSession();
        $storedCart = $this->createOrGetSessionCart($session);

        $storedCart->removeProductPosition($id);
        $session->set('cart', $this->serializerService->serialize($storedCart));
        $session->set('cart-products-count', $storedCart->getTotalCount());
    }
}