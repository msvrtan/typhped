<?php

declare(strict_types=1);

namespace spec\Typhped\Parser;

use PhpSpec\ObjectBehavior;
use Typhped\Parser\SimpleParser;
use Typhped\Tokenizer\Tokenizer;

class SimpleParserSpec extends ObjectBehavior
{
    public function let(Tokenizer $tokenizer)
    {
        $this->beConstructedWith($tokenizer);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(SimpleParser::class);
    }
}
