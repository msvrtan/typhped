<?php

declare(strict_types=1);

namespace spec\Typhped\Converter;

use PhpSpec\ObjectBehavior;
use Typhped\Converter\NikicConverter;

class NikicConverterSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(NikicConverter::class);
    }
}
