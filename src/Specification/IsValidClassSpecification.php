<?php

declare(strict_types=1);

namespace Ovvio\Component\Serializer\Specification;

use Ovvio\Component\Serializer\Exception\SerializerException;

use function class_exists;
use function substr;

/**
 * Is valid class specification
 */
final class IsValidClassSpecification
{
    /**
     * @throws SerializerException
     */
    public static function isSatisfiedBy(string $className): void
    {
        if (true === empty($className)) {
            throw new SerializerException('Unable to load class. Empty string');
        }

        if (substr($className, 0, 1) <> '\\') {
            $className = '\\' . $className;
        }

        if (false === class_exists($className, false)) {
            throw new SerializerException('Unable to load class: ' . $className);
        }
    }
}
