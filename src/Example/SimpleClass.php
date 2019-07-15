<?php

declare(strict_types=1);

namespace Example;

use stdClass;

class SimpleClass extends stdClass
{
    /** @var mixed */
    private $property;

    /** @var string */
    public $exposed;

    public function __construct(int $property, string $exposed)
    {
        $this->property = $property;
        $this->exposed  = $exposed;
        $this->joj      = '123 - 323';
        $this->joj      = 22;
        $this->joj      = 22.1;
    }

    /**
     * @return mixed
     */
    public function getProperty()
    {
        return $this->property;
    }

    public function getPropertyAsString(): string
    {
        return $this->property->string;
    }
}
