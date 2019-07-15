<?php

declare(strict_types=1);

namespace Typhped\Printer;

interface Printer
{
    public function print(array $ast): string;
}
