<?php

declare(strict_types=1);

namespace Typhped\Tokenizer;

interface Tokenizer
{
    public function tokenize(string $code): TokenCollection;
}
