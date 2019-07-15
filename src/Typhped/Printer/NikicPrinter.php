<?php

declare(strict_types=1);

namespace Typhped\Printer;

use PhpParser\PrettyPrinter\Standard;

class NikicPrinter implements Printer
{
    public function print(array $ast): string
    {
        $prettyPrinter = new Standard();

        return $prettyPrinter->prettyPrint($ast);
    }
}
