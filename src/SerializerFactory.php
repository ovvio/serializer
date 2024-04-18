<?php

declare(strict_types=1);

namespace Ovvio\Component\Serializer;

final class SerializerFactory
{
    public static function create(): SerializerInterface
    {
        return new Serializer();
    }
}
