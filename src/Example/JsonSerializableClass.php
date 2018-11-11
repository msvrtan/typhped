<?php

declare(strict_types=1);

namespace Example;

class JsonSerializableClass implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [];
    }
}
