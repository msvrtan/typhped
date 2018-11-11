<?php

declare(strict_types=1);

namespace Typhped\Tokenizer;

use Exception;
use Typhped\Tokenizer\Manual\Token;
use Typhped\Tokenizer\Manual\TokenAssignement;
use Typhped\Tokenizer\Manual\TokenClass;
use Typhped\Tokenizer\Manual\TokenDeclare;
use Typhped\Tokenizer\Manual\TokenGeneric;
use Typhped\Tokenizer\Manual\TokenLNumber;
use Typhped\Tokenizer\Manual\TokenNamespace;
use Typhped\Tokenizer\Manual\TokenOpenTag;
use Typhped\Tokenizer\Manual\TokenString;
use Typhped\Tokenizer\Manual\TokenWhitespace;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ManualTokenizer implements Tokenizer
{
    /** @var array */
    private $whitespace = [' ', "\n"];

    /** @var array */
    private $generic = [';', '{', '}', '(', ')', ','];

    /** @var array */
    private $assignement = ['='];

    /** @var array */
    private $delimiters = [];

    /** @var int */
    private $currentPosition = 0;

    /** @var int */
    private $endPosition = 0;

    /** @var array */
    private $tokens = [];

    /** @var string */
    private $code = '';

    public function __construct()
    {
        $this->delimiters = array_merge($this->whitespace, $this->generic, $this->assignement);
    }

    public function tokenize(string $code): TokenCollection
    {
        $this->code            = $code;
        $this->currentPosition = 0;
        $this->endPosition     = strlen($this->code);
        $this->tokens          = [];

        $current = null;

        for ($this->currentPosition = 0; $this->currentPosition < $this->endPosition; ++$this->currentPosition) {
            $char = $this->code[$this->currentPosition];
            if ($this->isDelimiter($char)) {
                if (null !== $current) {
                    $this->tokens[] = $this->detect($current);
                }
                if ($this->isGeneric($char)) {
                    $this->tokens[] = new TokenGeneric($char);
                } elseif ($this->isAssignement($char)) {
                    $this->tokens[] = new TokenAssignement();
                } elseif ($this->isWhitespace($char)) {
                    $this->processWhitespace();
                } else {
                    throw new Exception('Unrecognized char'.$char);
                }
                $current = null;
            } else {
                $current .= $char;
            }
        }
        if (null !== $current) {
            $this->tokens[] = $this->detect($current);
        }

        return new TokenCollection($this->tokens);
    }

    private function processWhitespace(): void
    {
        $current = null;
        for (; $this->currentPosition < $this->endPosition; ++$this->currentPosition) {
            $char = $this->code[$this->currentPosition];

            if ($this->isWhitespace($char)) {
                $current .= $char;
            } else {
                $this->tokens[] = new TokenWhitespace($current);
                --$this->currentPosition;

                return;
            }
        }
    }

    /**
     * @param mixed $input
     */
    public function detect($input): Token
    {
        if (true === in_array($input, ['<?php'], true)) {
            return new TokenOpenTag($input);
        }
        if ('namespace' === $input) {
            return new TokenNamespace();
        }
        if ('class' === $input) {
            return new TokenClass();
        }
        if ('declare' === $input) {
            return new TokenDeclare();
        }

        if (is_numeric($input)) {
            return new TokenLNumber((int) $input);
        }

        if (is_string($input)) {
            return new TokenString($input);
        }
        throw new Exception('Unsupported detection of '.$input);
    }

    /**
     * @param mixed $char
     */
    private function isDelimiter($char): bool
    {
        return in_array($char, $this->delimiters, true);
    }

    /**
     * @param mixed $char
     */
    private function isWhitespace($char): bool
    {
        return in_array($char, $this->whitespace, true);
    }

    /**
     * @param mixed $char
     */
    private function isGeneric($char): bool
    {
        return in_array($char, $this->generic, true);
    }

    /**
     * @param mixed $char
     */
    private function isAssignement($char): bool
    {
        return in_array($char, $this->assignement, true);
    }
}
