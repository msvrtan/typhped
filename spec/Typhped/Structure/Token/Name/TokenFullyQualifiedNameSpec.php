<?php

declare(strict_types=1);

namespace spec\Typhped\Structure\Token\Name;

use PhpSpec\ObjectBehavior;
use Typhped\Structure\Token\Name\TokenFullyQualifiedName;

class TokenFullyQualifiedNameSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(TokenFullyQualifiedName::class);
    }
}
