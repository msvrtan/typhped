<?php

declare(strict_types=1);

namespace Typhped\Structure\Token;

class TokenIdenitifier
{
    /** @var string */
    private $identifier;

    public function __construct(string $identifier)
    {
        $this->identifier = $identifier;
    }
}
