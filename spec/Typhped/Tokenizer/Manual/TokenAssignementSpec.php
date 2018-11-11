<?php

declare(strict_types=1);

namespace spec\Typhped\Tokenizer\Manual;

use PhpSpec\ObjectBehavior;
use Typhped\Tokenizer\Manual\Token;
use Typhped\Tokenizer\Manual\TokenAssignement;

class TokenAssignementSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(TokenAssignement::class);
        $this->shouldImplement(Token::class);
    }
}
