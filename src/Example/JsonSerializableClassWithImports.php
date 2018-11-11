<?php

declare(strict_types=1);

namespace Example;

use JsonSerializable;

class JsonSerializableClass implements JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [];
    }
}
