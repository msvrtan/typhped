<?php

declare(strict_types=1);

namespace Typhped\Converter;

interface Converter
{
    public function convert(array $input): array;
}
