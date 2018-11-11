<?php

declare(strict_types=1);

namespace spec\Typhped\Tokenizer\Regex;

use PhpSpec\ObjectBehavior;
use Typhped\Tokenizer\Regex\Token;

class TokenSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith($pattern = 'pattern', $replacement = 'replacement', $options = 's');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Token::class);
    }

    public function it_exposes_pattern()
    {
        $this->getPattern()->shouldReturn('/pattern/s');
    }

    public function it_exposes_replacement()
    {
        $this->getReplacement()->shouldReturn('replacement');
    }
}
