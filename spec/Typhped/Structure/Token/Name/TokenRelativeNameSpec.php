<?php

declare(strict_types=1);

namespace spec\Typhped\Structure\Token\Name;

use PhpSpec\ObjectBehavior;
use Typhped\Structure\Token\Name\TokenRelativeName;

class TokenRelativeNameSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(TokenRelativeName::class);
    }
}
