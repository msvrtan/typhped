<?php

declare(strict_types=1);

namespace spec\Typhped\Tokenizer\Manual;

use PhpSpec\ObjectBehavior;
use Typhped\Tokenizer\Manual\Token;
use Typhped\Tokenizer\Manual\TokenLNumber;

class TokenLNumberSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(1);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(TokenLNumber::class);
        $this->shouldImplement(Token::class);
    }
}
