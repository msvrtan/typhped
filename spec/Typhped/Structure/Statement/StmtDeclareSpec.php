<?php

declare(strict_types=1);

namespace spec\Typhped\Structure\Statement;

use PhpSpec\ObjectBehavior;
use Typhped\Structure\Statement\StmtDeclare;
use Typhped\Structure\Token\TokenIdenitifier;
use Typhped\Structure\Token\TokenLNumber;

class StmtDeclareSpec extends ObjectBehavior
{
    public function let(TokenIdenitifier $idenitifier, TokenLNumber $value)
    {
        $this->beConstructedWith($idenitifier, $value);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(StmtDeclare::class);
    }
}
