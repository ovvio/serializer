<?php

declare(strict_types=1);

namespace Ovvio\Component\Serializer;

use Symfony\Component\Serializer as SymfonySerializer;

use function get_class;
use function is_string;

/**
 * Serializer
 */
final class Serializer implements SerializerInterface
{
    private SymfonySerializer\Serializer $serializer;

    public function __construct(
        null|string $datetimeFormat = SerializerDef::DEFAULT_DATE_TIME_FORMAT,
    ) {
        $normalizers = [];

        $normalizers[] = new SymfonySerializer\Normalizer\ObjectNormalizer();

        if (null !== $datetimeFormat) {
            $normalizers[] = new SymfonySerializer\Normalizer\DateTimeNormalizer([
                SymfonySerializer\Normalizer\DateTimeNormalizer::FORMAT_KEY => $datetimeFormat,
            ]);
        }

        $encoders = [];
        $encoders[] = new SymfonySerializer\Encoder\JsonEncoder();

        $this->serializer = new SymfonySerializer\Serializer($normalizers, $encoders);
    }

    /**
     * @see SerializerInterface
     */
    #[\Override]
    public function arrayToJson(array $array): string
    {
        return $this->serializer->encode($array, SymfonySerializer\Encoder\JsonEncoder::FORMAT);
    }

    /**
     * @see SerializerInterface
     */
    #[\Override]
    public function arrayToObject(array $array, string|object $classNameOrObject): object
    {
        $object = $classNameOrObject;
        if (true === is_string($classNameOrObject)) {
            Specification\IsValidClassSpecification::isSatisfiedBy($classNameOrObject);
            $className = $classNameOrObject;
            $object = $this->serializer->denormalize(data: $array, type: $className);
        } else {
            $className = get_class($object);
            $context = [SymfonySerializer\Normalizer\AbstractNormalizer::OBJECT_TO_POPULATE => $object];
            $this->serializer->denormalize(data: $array, type: $className, context: $context);
        }

        return $object;
    }

    /**
     * @see SerializerInterface
     */
    #[\Override]
    public function jsonToArray(string $json): array
    {
        Specification\IsValidJsonSpecification::isSatisfiedBy($json);

        /** @var array<string|int, null|object{0: \Ovvio\Component\Serializer\__tostring}>()}|scalar> */
        $array = $this->serializer->decode($json, SymfonySerializer\Encoder\JsonEncoder::FORMAT);

        return $array;
    }

    /**
     * @see SerializerInterface
     */
    #[\Override]
    public function jsonToObject(string $json, string|object $classNameOrObject): object
    {
        Specification\IsValidJsonSpecification::isSatisfiedBy($json);

        if (true === is_string($classNameOrObject)) {
            Specification\IsValidClassSpecification::isSatisfiedBy($classNameOrObject);
            $className = $classNameOrObject;
            $object = $this->serializer->deserialize($json, $className, SymfonySerializer\Encoder\JsonEncoder::FORMAT);
        } else {
            $object = $classNameOrObject;
            $className = get_class($object);
            $format = SymfonySerializer\Encoder\JsonEncoder::FORMAT;
            $context = [SymfonySerializer\Normalizer\AbstractNormalizer::OBJECT_TO_POPULATE => $object];
            $this->serializer->deserialize(data: $json, type: $className, format: $format, context: $context);
        }

        return $object;
    }

    /**
     * @see SerializerInterface
     */
    #[\Override]
    public function objectToArray(object $object): array
    {
        $result = $this->serializer->normalize($object);

        return (array) ($result ?? []);
    }

    /**
     * @see SerializerInterface
     */
    #[\Override]
    public function objectToJson(object $object): string
    {
        $json = $this->serializer->serialize($object, SymfonySerializer\Encoder\JsonEncoder::FORMAT);

        Specification\IsValidJsonSpecification::isSatisfiedBy($json);

        return $json;
    }
}
