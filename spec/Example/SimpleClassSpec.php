<?php

declare(strict_types=1);

namespace spec\Example;

use Example\SimpleClass;
use PhpSpec\ObjectBehavior;

class SimpleClassSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(SimpleClass::class);
    }
}
