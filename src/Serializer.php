<?php

declare(strict_types=1);

namespace Ovvio\Component\Serializer;

use Symfony\Component\Serializer as SymfonySerializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer as Normalizer;

use function json_validate;

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

        $normalizers[] = new Normalizer\ObjectNormalizer(
            // propertyTypeExtractor: new ReflectionExtractor(),
        );

        if (null !== $datetimeFormat) {
            $normalizers[] = new Normalizer\DateTimeNormalizer([
                Normalizer\DateTimeNormalizer::FORMAT_KEY => $datetimeFormat,
            ]);
        }

        $encoders = [];
        $encoders[] = new JsonEncoder();

        $this->serializer = new SymfonySerializer\Serializer($normalizers, $encoders);
    }

    /**
     * @see SerializerInterface
     */
    public function jsonToObject(string $json, string $className): object
    {
        return $this->serializer->deserialize($json, $className, SymfonySerializer\Encoder\JsonEncoder::FORMAT);
    }

    /**
     * @see SerializerInterface
     */
    public function arrayToJson(array $array): string
    {
        return $this->serializer->encode($array, SymfonySerializer\Encoder\JsonEncoder::FORMAT);
    }

    /**
     * @see SerializerInterface
     */
    public function objectToArray(object $object): null|array
    {
        $result = $this->serializer->normalize($object);

        if (null === $result) {
            return null;
        }

        return (array) $result;
    }

    /**
     * @see SerializerInterface
     */
    public function objectToJson(object $object): string
    {
        $json = $this->serializer->serialize($object, SymfonySerializer\Encoder\JsonEncoder::FORMAT);

        return $json;
    }

    /**
     * @see SerializerInterface
     */
    public function jsonToArray(string $json): null|array
    {
        if (true === json_validate($json)) {
            throw new \Exception('JSON verification error!', 0);
        }

        /** @var mixed $result */
        $result = $this->serializer->decode($json, SymfonySerializer\Encoder\JsonEncoder::FORMAT);

        if (null === $result) {
            return null;
        }

        return (array) $result;
    }

    /**
     * @see SerializerInterface
     */
    public function toArray(mixed $data): null|array
    {
        $result = $this->serializer->normalize($data);

        if (null === $result) {
            return null;
        }

        return (array) $result;
    }
}
