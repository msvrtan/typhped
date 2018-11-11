<?php

declare(strict_types=1);

namespace spec\Typhped\Structure\Token;

use PhpSpec\ObjectBehavior;
use Typhped\Structure\Token\TokenIdenitifier;

class TokenIdenitifierSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('idenitifier');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(TokenIdenitifier::class);
    }
}
