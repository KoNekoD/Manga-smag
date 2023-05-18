<?php

declare(strict_types=1);

namespace App\Products\Service;

use App\Products\DTO\CartDTO;
use App\Products\Repository\ProductRepository;
use App\Shared\Service\SerializerServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;

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
    }

    public function getCartAndRefreshData(): CartDTO
    {
        $session = $this->requestStack->getSession();

        if (null === $session->get('cart')) {
            $storedCart = new CartDTO();
            $session->set('cart', $this->serializerService->serialize($storedCart));
        } else {
            $storedCart = $this->serializerService->deserialize(
                $session->get('cart'),
                CartDTO::class
            );
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