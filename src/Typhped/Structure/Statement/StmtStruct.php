<?php

declare(strict_types=1);

namespace Typhped\Structure\Statement;

use Typhped\Structure\Token\TokenName;
use Webmozart\Assert\Assert;

class StmtStruct implements StmtStructure
{
    /** @var TokenName */
    private $name;

    /** @var TokenName|null */
    private $parentName;

    /** @var array */
    private $interfaces;

    /** @var array */
    private $statements;

    public function __construct(TokenName $name, ?TokenName $parentName, array $interfaces, array $statements)
    {
        $this->name       = $name;
        $this->parentName = $parentName;
        $this->interfaces = $interfaces;
        $this->statements = $statements;

        Assert::allIsInstanceOf($interfaces, TokenName::class);
    }

    public function getNameAsString(): string
    {
        return $this->name->asString();
    }

    public function hasParent(): bool
    {
        return null !== $this->parentName;
    }

    public function getParentNameAsString(): string
    {
        return $this->parentName->asString();
    }

    public function hasInterfaces(): bool
    {
        return count($this->interfaces) > 0;
    }

    public function getInterfaces(): array
    {
        return $this->interfaces;
    }

    public function getStatements(): array
    {
        return $this->statements;
    }
}
