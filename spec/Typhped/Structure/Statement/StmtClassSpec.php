<?php

declare(strict_types=1);

namespace spec\Typhped\Structure\Statement;

use PhpSpec\ObjectBehavior;
use Typhped\Structure\Statement\StmtClass;
use Typhped\Structure\Token\TokenName;

class StmtClassSpec extends ObjectBehavior
{
    public function let(TokenName $name, TokenName $parentName)
    {
        $this->beConstructedWith($name, $parentName, []);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(StmtClass::class);
    }
}
