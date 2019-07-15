<?php

declare(strict_types=1);

namespace Typhped\Structure\Statement;

use Typhped\Structure\Token\TokenName;
use Webmozart\Assert\Assert;

class StmtNamespace
{
    /** @var \Typhped\Structure\Token\TokenName */
    private $name;

    /** @var array */
    private $statements;

    public function __construct(TokenName $name, array $statements)
    {
        $this->name       = $name;
        $this->statements = $statements;

        Assert::allIsInstanceOf($statements, StmtStructure::class);
    }

    public function getNameAsString(): string
    {
        return $this->name->asString();
    }

    public function getStatements(): array
    {
        return $this->statements;
    }
}
