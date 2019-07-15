<?php

declare(strict_types=1);

namespace Typhped\Parser;

interface Parser
{
    public function parse(string $code): array;
}
