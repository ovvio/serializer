<?php

declare(strict_types=1);

namespace Ovvio\Component\Serializer;

use DateTimeInterface;

/**
 * Serializer definition
 */
final class SerializerDef
{
    /**
     * Date or (and) time formats
     */
    public const DEFAULT_DATE_TIME_FORMAT = DateTimeInterface::W3C;
    public const DATE_FORMAT = 'd.m.Y';
    public const TIME_FORMAT = 'H:i:s';
    public const DATE_TIME_FORMAT = 'd.m.Y H:i:s';
    public const API_DATE_TIME_FORMAT = DateTimeInterface::W3C;
    public const API_DATE_FORMAT = 'Y-m-d';
    public const DB_DATE_FORMAT = 'Y-m-d';
    public const DB_DATE_TIME_FORMAT = 'Y-m-d H:i:s';
}
