<?php

declare(strict_types=1);

namespace Typhped\Structure\Statement;

use Typhped\Structure\Token\TokenVariable;
use Typhped\Tokenizer\Manual\TokenString;

class StmtProperty
{
    /** @var TokenString */
    private $type;

    /** @var TokenVariable */
    private $variable;

    public function __construct(TokenString $type, TokenVariable $variable)
    {
        $this->type     = $type;
        $this->variable = $variable;
    }

    public function getType(): string
    {
        return $this->type->getValue();
    }

    public function getName(): string
    {
        return $this->variable->getName();
    }
}
