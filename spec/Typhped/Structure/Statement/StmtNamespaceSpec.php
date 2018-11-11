<?php

declare(strict_types=1);

namespace spec\Typhped\Structure\Statement;

use PhpSpec\ObjectBehavior;
use Typhped\Structure\Statement\StmtClass;
use Typhped\Structure\Statement\StmtNamespace;
use Typhped\Structure\Token\TokenName;

class StmtNamespaceSpec extends ObjectBehavior
{
    public function let(TokenName $name, StmtClass $class)
    {
        $this->beConstructedWith($name, [$class]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(StmtNamespace::class);
    }
}
