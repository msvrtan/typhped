<?php

declare(strict_types=1);

namespace Typhped\Parser;

use Exception;
use Typhped\Structure\Statement\StmtClass;
use Typhped\Structure\Statement\StmtDeclare;
use Typhped\Structure\Statement\StmtNamespace;
use Typhped\Structure\Statement\StmtProperty;
use Typhped\Structure\Statement\StmtStruct;
use Typhped\Structure\Statement\StmtStructure;
use Typhped\Structure\Token\TokenIdenitifier;
use Typhped\Structure\Token\TokenLNumber;
use Typhped\Structure\Token\TokenName;
use Typhped\Structure\Token\TokenVariable;
use Typhped\Tokenizer\Manual\TokenAssignement;
use Typhped\Tokenizer\Manual\TokenClass;
use Typhped\Tokenizer\Manual\TokenDeclare;
use Typhped\Tokenizer\Manual\TokenGeneric;
use Typhped\Tokenizer\Manual\TokenLNumber as ManualTokenLNumber;
use Typhped\Tokenizer\Manual\TokenNamespace;
use Typhped\Tokenizer\Manual\TokenString;
use Typhped\Tokenizer\Manual\TokenStruct;
use Typhped\Tokenizer\Tokenizer;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 */
class SimpleParser implements Parser
{
    /** @var Tokenizer */
    private $tokenizer;

    /** @var int */
    private $currentPosition = 0;

    /** @var int */
    private $endPosition = 0;

    /** @var array */
    private $tokenized = [];

    /** @var array */
    private $tokens = [];

    public function __construct(Tokenizer $tokenizer)
    {
        $this->tokenizer = $tokenizer;
    }

    public function parse(string $code): array
    {
        $this->tokenized       = $this->tokenizer->tokenize($code)->getValuesWithoutWhitespace();
        $this->currentPosition = 0;
        $this->endPosition     = count($this->tokenized);

        $this->tokens = [];

        for (; $this->currentPosition < $this->endPosition; ++$this->currentPosition) {
            $this->tokens[] = $this->process();
        }

        return $this->tokens;
    }

    private function hasMore(): bool
    {
        return $this->currentPosition < ($this->endPosition - 1);
    }

    /**
     * @throws Exception
     *
     * @return mixed
     */
    private function process()
    {
        $currentToken = $this->tokenized[$this->currentPosition];

        if ($currentToken instanceof TokenDeclare) {
            $this->assertNextIs(new TokenGeneric('('));

            $this->assertNextIsInstanceOf(TokenString::class);
            $identifier = new TokenIdenitifier($this->getCurrentToken()->getValue());

            $this->assertNextIs(new TokenAssignement());

            $this->assertNextIsInstanceOf(ManualTokenLNumber::class);
            $value = new TokenLNumber($this->getCurrentToken()->getValue());

            $this->assertNextIs(new TokenGeneric(')'));
            $this->assertNextIs(new TokenGeneric(';'));

            return new StmtDeclare($identifier, $value);
        } elseif ($currentToken instanceof TokenNamespace) {
            $this->assertNextIsInstanceOf(TokenString::class);

            $name = new TokenName($this->getCurrentToken()->getValue());

            $this->assertNextIs(new TokenGeneric(';'));

            $this->move();

            $classes = [];

            while (($nextOne = $this->process()) instanceof StmtStructure) {
                $classes[] = $nextOne;

                if ($this->hasMore()) {
                    $this->move();
                } else {
                    break;
                }
            }

            return new StmtNamespace($name, $classes);
        } elseif ($currentToken instanceof TokenClass) {
            $parentName = null;
            $interfaces = [];
            $this->assertNextIsInstanceOf(TokenString::class);

            $name = new TokenName($this->getCurrentToken()->getValue());

            if ($this->getNextToken() == new TokenString('extends')) {
                $this->move();
                $this->assertNextIsInstanceOf(TokenString::class);
                $parentName = new TokenName($this->getCurrentToken()->getValue());
            }

            if ($this->getNextToken() == new TokenString('implements')) {
                $this->move();
                $this->assertNextIsInstanceOf(TokenString::class);
                $interfaces[] = new TokenName($this->getCurrentToken()->getValue());

                if ($this->getNextToken() == new TokenGeneric(',')) {
                    $this->move();
                    $this->assertNextIsInstanceOf(TokenString::class);
                    $interfaces[] = new TokenName($this->getCurrentToken()->getValue());
                }
            }

            $this->assertNextIs(new TokenGeneric('{'));

            $this->assertNextIs(new TokenGeneric('}'));

            return new StmtClass($name, $parentName, $interfaces);
        } elseif ($currentToken instanceof TokenStruct) {
            return $this->processStruct();
        }

        throw new Exception('Failed processing'.$currentToken);
    }

    private function processStruct(): StmtStruct
    {
        $parentName = null;
        $interfaces = [];
        $this->assertNextIsInstanceOf(TokenString::class);

        $name = new TokenName($this->getCurrentToken()->getValue());

        if ($this->getNextToken() == new TokenString('implements')) {
            $this->move();
            $this->assertNextIsInstanceOf(TokenString::class);
            $interfaces[] = new TokenName($this->getCurrentToken()->getValue());

            if ($this->getNextToken() == new TokenGeneric(',')) {
                $this->move();
                $this->assertNextIsInstanceOf(TokenString::class);
                $interfaces[] = new TokenName($this->getCurrentToken()->getValue());
            }
        }

        $this->assertNextIs(new TokenGeneric('{'));

        /// process struct content!!

        if ($this->getNextToken() != new TokenGeneric('}')) {
            $statements = $this->processInsideStruct();
        } else {
            $statements = [];
        }

        $this->assertNextIs(new TokenGeneric('}'));

        return new StmtStruct($name, $parentName, $interfaces, $statements);
    }

    private function processInsideStruct(): array
    {
        $data = [];

        $this->move();

        while ($this->getCurrentToken() instanceof TokenString) {
            if ($this->getNextToken() instanceof TokenVariable) {
                $type = $this->getCurrentToken();
                $name = $this->next();

                $this->assertNextIs(new TokenGeneric(';'));

                $data[] = new StmtProperty($type, $name);

                if ($this->getNextToken() instanceof TokenString) {
                    $this->move();
                }
            }
        }

        return $data;
    }

    private function move(): void
    {
        ++$this->currentPosition;
    }

    /**
     * @return mixed
     */
    private function getCurrentToken()
    {
        return $this->tokenized[$this->currentPosition];
    }

    /**
     * @return mixed
     */
    private function getNextToken()
    {
        return $this->tokenized[$this->currentPosition + 1];
    }

    /**
     * @return mixed
     */
    private function next()
    {
        ++$this->currentPosition;

        return $this->tokenized[$this->currentPosition];
    }

    /**
     * @param mixed $expect
     */
    private function assertNextIs($expect): void
    {
        if ($this->next() != $expect) {
            throw new Exception(
                'Expecting "'.$expect->getValue().'", got "'.$this->getCurrentToken()->getValue().'"!!'
            );
        }
    }

    private function assertNextIsInstanceOf(string $expect): void
    {
        if (false === ($this->next() instanceof $expect)) {
            throw new Exception('Expecting '.$expect);
        }
    }
}
