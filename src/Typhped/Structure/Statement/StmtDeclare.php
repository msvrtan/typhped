<?php

declare(strict_types=1);

namespace Typhped\Structure\Statement;

use Typhped\Structure\Token\TokenIdenitifier;
use Typhped\Structure\Token\TokenLNumber;

class StmtDeclare
{
    /** @var TokenIdenitifier */
    private $idenitifier;

    /** @var TokenLNumber */
    private $value;

    public function __construct(TokenIdenitifier $idenitifier, TokenLNumber $value)
    {
        $this->idenitifier = $idenitifier;
        $this->value       = $value;
    }

    public static function enforceStrictTypes(): self
    {
        return new StmtDeclare(
            new TokenIdenitifier('strict_types'),
            new TokenLNumber(1)
        );
    }
}
