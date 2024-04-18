# Serializer

Handles serializing and deserializing data structures, including object graphs, into array structures or other formats like XML and JSON.

## Technical Requirements & Installation

[PHP 8.4](https://www.php.net/releases/8.4/en.php) - [Installation and Configuration](https://www.php.net/manual/en/install.php)

[Composer (System Requirements)](https://getcomposer.org/doc/00-intro.md#system-requirements)

To install run this:

```bash
composer require ovvio/serializer
```

## Examples

```php
<?php

...

use Ovvio\Component\Serializer\SerializerFactory;

...

/**
 * Example 1: JSON to array
 */
/** @var \Ovvio\Component\Serializer\SerializerInterface $serializer */
$serializer = SerializerFactory::create();

/** @var string $json */
$json = <<<JSON
{
    "foo": "Foo",
    "bar": "Bar"
}
JSON;

/** @var null|array $array */
$array = $serializer->jsonToArray(json: $json);

/**
 * Example 2: array to JSON
 */
/** @var array $array */
$array = [
    'foo' => 'Foo',
    'bar' => 'Bar',
];

/** @var string $json */
$json = $serializer->arrayToJson(array: $array);

```