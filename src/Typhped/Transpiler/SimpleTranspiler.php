<?php

declare(strict_types=1);

namespace Typhped\Transpiler;

use Typhped\Converter\Converter;
use Typhped\Parser\Parser;
use Typhped\Printer\Printer;

class SimpleTranspiler implements Transpiler
{
    /** @var Parser */
    private $parser;

    /** @var Converter */
    private $converter;

    /** @var Printer */
    private $printer;

    public function __construct(Parser $parser, Converter $converter, Printer $printer)
    {
        $this->parser    = $parser;
        $this->converter = $converter;
        $this->printer   = $printer;
    }

    public function transpile(string $input): string
    {
        $tokens = $this->parser->parse($input);

        $converted = $this->converter->convert($tokens);

        $output = $this->printer->print($converted);

        return $output;
    }
}
