<?php

declare(strict_types=1);

namespace spec\Typhped\Tokenizer\Manual;

use PhpSpec\ObjectBehavior;
use Typhped\Tokenizer\Manual\Token;
use Typhped\Tokenizer\Manual\TokenGeneric;

class TokenGenericSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(';');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(TokenGeneric::class);
        $this->shouldImplement(Token::class);
    }
}
