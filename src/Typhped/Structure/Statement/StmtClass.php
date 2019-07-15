<?php

declare(strict_types=1);

namespace Typhped\Structure\Statement;

use Typhped\Structure\Token\TokenName;
use Webmozart\Assert\Assert;

class StmtClass implements StmtStructure
{
    /** @var TokenName */
    private $name;

    /** @var TokenName|null */
    private $parentName;

    /** @var array */
    private $interfaces;

    public function __construct(TokenName $name, ?TokenName $parentName, array $interfaces)
    {
        $this->name       = $name;
        $this->parentName = $parentName;
        $this->interfaces = $interfaces;

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
}
