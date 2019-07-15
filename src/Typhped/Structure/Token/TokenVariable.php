<?php

declare(strict_types=1);

namespace Typhped\Structure\Token;

use Typhped\Tokenizer\Manual\Token;

class TokenVariable implements Token
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
