<?php

declare(strict_types=1);

namespace spec\Typhped\Tokenizer\Manual;

use PhpSpec\ObjectBehavior;
use Typhped\Tokenizer\Manual\Token;
use Typhped\Tokenizer\Manual\TokenOpenTag;

class TokenOpenTagSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('<?php');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(TokenOpenTag::class);
        $this->shouldImplement(Token::class);
    }
}
