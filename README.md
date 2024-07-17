# Serializer

Handles serializing and deserializing data structures, including object graphs, into array structures or other formats like XML and JSON.

## Technical Requirements & Installation

[PHP 8.3](https://www.php.net/releases/8.3/en.php) - [Installation and Configuration](https://www.php.net/manual/en/install.php)

[Composer (System Requirements)](https://getcomposer.org/doc/00-intro.md#system-requirements)

To install run this:

```bash
composer require ovvio/serializer
```

## Example

```php
use Ovvio\Component\Serializer\SerializerFactory;

...

$serializer = SerializerFactory::create();

$data = <<<JSON
{
    "foo": "Foo",
    "bar": "Bar"
}
JSON;

$array = $serializer->toArray($data);
```