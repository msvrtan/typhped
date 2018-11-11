<?php

declare(strict_types=1);

namespace Typhped\Structure\Token;

class TokenLNumber
{
    /** @var int */
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }
}
