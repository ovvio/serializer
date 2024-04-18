<?php

declare(strict_types=1);

namespace Ovvio\Component\Serializer;

use LogicException;
use stdClass;

interface SerializerInterface
{
    /**
     * Deserialize JSON to object
     *
     * @param string              $json              JSON
     * @param class-string|object $classNameOrObject Class name or object
     *
     * @return object Object
     *
     * @throws LogicException
     */
    public function jsonToObject(string $json, string|object $classNameOrObject = stdClass::class): object;

    /**
     * Encode array to JSON
     *
     * @param array $array Array
     *
     * @return string JSON
     */
    public function arrayToJson(array $array): string;

    /**
     * Normalize object to array
     *
     * @param object $object Object
     *
     * @return array Array
     *
     * @throws LogicException
     */
    public function objectToArray(object $object): array;

    /**
     * Serialize object to JSON
     *
     * @param object $object Object
     *
     * @return string JSON
     *
     * @throws LogicException
     */
    public function objectToJson(object $object): string;

    /**
     * Decode JSON to array
     *
     * @param string $json JSON
     *
     * @return array<array-key, null|object{__tostring()}|scalar> Array
     *
     * @throws LogicException
     */
    public function jsonToArray(string $json): array;
}
