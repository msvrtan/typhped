<?php

declare(strict_types=1);

namespace Typhped\Tokenizer;

use Typhped\Tokenizer\Manual\TokenWhitespace;

class TokenCollection
{
    /** @var array */
    private $values;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function asString(): string
    {
        return implode('', $this->values);
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function getValuesWithoutWhitespace(): array
    {
        $values = [];

        foreach ($this->values as $value) {
            if (false === $value instanceof TokenWhitespace) {
                $values[] = $value;
            }
        }

        return $values;
    }
}
