<?php

declare(strict_types=1);

namespace spec\Typhped\Structure\Token;

use PhpSpec\ObjectBehavior;
use Typhped\Structure\Token\TokenLNumber;

class TokenLNumberSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(1);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(TokenLNumber::class);
    }
}
