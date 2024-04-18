<?php

declare(strict_types=1);

namespace Ovvio\Component\Serializer;

interface SerializerInterface
{
    /**
     * @param string       $json
     * @param class-string $className Class name
     *
     * @return object
     */
    public function jsonToObject(string $json, string $className): object;

    /**
     * @param array $array Array
     *
     * @return string
     */
    public function arrayToJson(array $array): string;

    /**
     * @param object $object
     *
     * @return null|array
     */
    public function objectToArray(object $object): null|array;

    /**
     * @param object $object
     *
     * @return string
     */
    public function objectToJson(object $object): string;

    /**
     * @param mixed $data Data
     *
     * @return null|array
     */
    public function toArray(mixed $data): null|array;
}
