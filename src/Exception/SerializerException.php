<?php

declare(strict_types=1);

namespace Ovvio\Component\Serializer\Exception;

use Ovvio\Exceptions\BaseException;
use Ovvio\Exceptions\Exceptions;

/**
 * Serializer exception
 */
class SerializerException extends BaseException
{
    public function __construct(
        string $message,
        ?int $code = Exceptions::EXCEPTION_CODE_DEFAULT,
        ?\Throwable $previous = null,
    ) {
        parent::__construct(
            message: $message,
            code: $code ?? Exceptions::EXCEPTION_CODE_DEFAULT,
            previous: $previous,
        );
    }
}
