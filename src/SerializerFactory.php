<?php

declare(strict_types=1);

namespace Ovvio\Component\Serializer;

final class SerializerFactory
{
    public static function create(
        null|string $datetimeFormat = SerializerDef::DEFAULT_DATE_TIME_FORMAT,
    ): SerializerInterface {
        return new Serializer(datetimeFormat: $datetimeFormat);
    }
}
