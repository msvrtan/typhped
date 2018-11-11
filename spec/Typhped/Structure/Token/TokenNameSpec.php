<?php

declare(strict_types=1);

namespace spec\Typhped\Structure\Token;

use PhpSpec\ObjectBehavior;
use Typhped\Structure\Token\TokenName;

class TokenNameSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith($name = 'name');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(TokenName::class);
    }
}
