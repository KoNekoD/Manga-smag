<?php

declare(strict_types=1);

namespace App\Cart\Infrastructure\Service;

use App\Cart\Infrastructure\DTO\CartDTO;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Domain\Service\SerializerServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    public function __construct(
        private readonly RequestStack               $requestStack,
        private readonly ProductRepositoryInterface $productRepository,
        private readonly SerializerServiceInterface $serializerService,
    )
    {
    }

    public function clearCart(): void
    {
        $session = $this->requestStack->getSession();
        $session->set('cart', $this->serializerService->serialize(new CartDTO()));
    }

    public function getCartAndRefreshData(): CartDTO
    {
        $session = $this->requestStack->getSession();

        $storedCart = $this->serializerService->deserialize(
            $session->get('cart'),
            CartDTO::class
        );

        if (null === $storedCart) {
            $storedCart = new CartDTO();
            $session->set('cart', $this->serializerService->serialize($storedCart));
        }

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
        }

        return $storedCart;
    }

    public function addOneProduct(int $id): void
    {
        $session = $this->requestStack->getSession();

        /** @var CartDTO $storedCart */
        $storedCart = $this->serializerService->deserialize(
            $session->get('cart'),
            CartDTO::class
        );

        $product = $this->productRepository->findById($id);

        $storedCart->addProduct(
            $id,
            $product->getName(),
            $product->getPrice(),
            $product->getImage()
        );
        $session->set('cart', $this->serializerService->serialize($storedCart));
    }

    public function removeOneProduct(int $id): void
    {
        $session = $this->requestStack->getSession();

        /** @var CartDTO $storedCart */
        $storedCart = $this->serializerService->deserialize(
            $session->get('cart'),
            CartDTO::class
        );

        $product = $this->productRepository->findById($id);

        $storedCart->removeProduct(
            $id,
            $product->getName(),
            $product->getPrice(),
            $product->getImage()
        );
        $session->set('cart', $this->serializerService->serialize($storedCart));
    }
}