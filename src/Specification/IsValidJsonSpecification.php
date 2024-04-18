<?php

declare(strict_types=1);

namespace Ovvio\Component\Serializer\Specification;

use LogicException;

use function json_validate;

/**
 * Is valid JSON specification
 */
final class IsValidJsonSpecification
{
    public static function isSatisfiedBy(string $json): void
    {
        if (false === json_validate($json)) {
            throw new LogicException('JSON is not valid.', 0);
        }
    }
}
