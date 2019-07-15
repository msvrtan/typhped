<?php

declare(strict_types=1);

namespace spec\Typhped\Tokenizer\Manual;

use PhpSpec\ObjectBehavior;
use Typhped\Tokenizer\Manual\Token;
use Typhped\Tokenizer\Manual\TokenStruct;

class TokenStructSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(TokenStruct::class);
        $this->shouldImplement(Token::class);
    }
}
