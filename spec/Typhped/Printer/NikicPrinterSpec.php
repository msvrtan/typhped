<?php

declare(strict_types=1);

namespace spec\Typhped\Printer;

use PhpSpec\ObjectBehavior;
use Typhped\Printer\NikicPrinter;

class NikicPrinterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(NikicPrinter::class);
    }
}
