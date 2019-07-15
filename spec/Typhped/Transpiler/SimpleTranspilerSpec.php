<?php

declare(strict_types=1);

namespace spec\Typhped\Transpiler;

use PhpSpec\ObjectBehavior;
use Typhped\Converter\Converter;
use Typhped\Parser\Parser;
use Typhped\Printer\Printer;
use Typhped\Transpiler\SimpleTranspiler;

class SimpleTranspilerSpec extends ObjectBehavior
{
    public function let(Parser $parser, Converter $converter, Printer $printer)
    {
        $this->beConstructedWith($parser, $converter, $printer);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(SimpleTranspiler::class);
    }

    public function it_will_transpile_given_input_into_php_code(Parser $parser, Converter $converter, Printer $printer)
    {
        $parser->parse('input')
            ->shouldBeCalled()
            ->willReturn(['tokens']);

        $converter->convert(['tokens'])
            ->shouldBeCalled()
            ->willReturn(['nikic-tokens']);

        $printer->print(['nikic-tokens'])
            ->shouldBeCalled()
            ->willReturn('output');

        //        $printer->print()
        //            ->shouldBeCalled()
        //            ->willReturn('output');

        $this->transpile('input')->shouldReturn('output');
    }
}
