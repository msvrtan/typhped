<?php

declare(strict_types=1);

namespace Typhped\Tokenizer\Manual;

class TokenWhitespace implements Token
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
