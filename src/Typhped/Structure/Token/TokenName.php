<?php

declare(strict_types=1);

namespace Typhped\Structure\Token;

class TokenName
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
