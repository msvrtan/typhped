<?php

declare(strict_types=1);

namespace spec\Typhped\Tokenizer\Manual;

use PhpSpec\ObjectBehavior;
use Typhped\Tokenizer\Manual\Token;
use Typhped\Tokenizer\Manual\TokenString;

class TokenStringSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('value');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(TokenString::class);
        $this->shouldImplement(Token::class);
    }
}
