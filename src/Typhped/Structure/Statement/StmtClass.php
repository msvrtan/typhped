<?php

declare(strict_types=1);

namespace Typhped\Structure\Statement;

use Typhped\Structure\Token\TokenName;
use Webmozart\Assert\Assert;

class StmtClass
{
    /** @var TokenName */
    private $name;

    /** @var null|TokenName */
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
}
