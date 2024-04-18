<?php

declare(strict_types=1);

namespace Ovvio\Component\Serializer\Specification;

use LogicException;

use function class_exists;

/**
 * Is valid class specification
 */
final class IsValidClassSpecification
{
    public static function isSatisfiedBy(string $className): void
    {
        if (false === class_exists($className, false)) {
            throw new LogicException('Unable to load class: ' . $className, 0);
        }
    }
}
