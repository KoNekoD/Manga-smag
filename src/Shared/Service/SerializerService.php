<?php

declare(strict_types=1);

namespace App\Shared\Service;

use ArrayObject;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerService implements SerializerServiceInterface
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    public function serialize(mixed $data, string $format = 'json'): string
    {
        return $this->serializer->serialize($data, $format);
    }

    public function deserialize(mixed $data, string $type, string $format = 'json'): mixed
    {
        return $this->serializer->deserialize($data, $type, $format);
    }

    /**
     * @throws ExceptionInterface
     *
     * @phpstan-ignore-next-line
     */
    public function normalize(mixed $data, ?string $format = null): string|int|bool|ArrayObject|array|float|null
    {
        return $this->serializer->normalize($data, $format);
    }

    /**
     * @throws ExceptionInterface
     */
    public function denormalize(mixed $data, string $type, ?string $format = null): mixed
    {
        return $this->serializer->denormalize($data, $type, $format);
    }
}
