<?php

declare(strict_types=1);

namespace Tests\Typhped\Parser\SimpleParser;

use Generator;
use PHPUnit\Framework\TestCase;
use Typhped\Parser\SimpleParser;
use Typhped\Structure\Statement\StmtDeclare;
use Typhped\Structure\Statement\StmtNamespace;
use Typhped\Structure\Statement\StmtProperty;
use Typhped\Structure\Statement\StmtStruct;
use Typhped\Structure\Token\TokenName;
use Typhped\Structure\Token\TokenVariable;
use Typhped\Tokenizer\Manual\TokenString;
use Typhped\Tokenizer\ManualTokenizer;

/**
 * @covers \Typhped\Parser\SimpleParser
 */
class SimpleStructTest extends TestCase
{
    /**
     * @dataProvider provideSimpleStruct
     * @dataProvider provideSimpleStructWithIntegerProperty
     * @dataProvider provideSimpleStructWithArrayProperty
     * @dataProvider provideSimpleStructWithNullableIntProperty
     * @dataProvider provideSimpleStructWithObjectProperty
     * @dataProvider provideSimpleStructWithMultipleIntegerProperties
     */
    public function testParse(string $code, array $expected): void
    {
        // Act
        $parser = new SimpleParser(new ManualTokenizer());
        $result = $parser->parse($code);

        // Assert

        self::assertEquals($expected, $result);
    }

    public function provideSimpleStruct(): Generator
    {
        $code = <<<'CODE'
declare(strict_types=1);

namespace Example;

struct SimpleStruct
{
}

CODE;

        yield [
            $code,
            [
                StmtDeclare::enforceStrictTypes(),
                new StmtNamespace(
                    new TokenName('Example'),
                    [
                        new StmtStruct(new TokenName('SimpleStruct'), null, [], []),
                    ]
                ),
            ],
        ];
    }

    public function provideSimpleStructWithIntegerProperty(): Generator
    {
        $code = <<<'CODE'
declare(strict_types=1);

namespace Example;

struct SimpleStruct
{
	int $value;
}

CODE;

        yield [
            $code,
            [
                StmtDeclare::enforceStrictTypes(),
                new StmtNamespace(
                    new TokenName('Example'),
                    [
                        new StmtStruct(
                            new TokenName('SimpleStruct'),
                            null,
                            [],
                            [
                                new StmtProperty(new TokenString('int'), new TokenVariable('value')),
                            ]
                        ),
                    ]
                ),
            ],
        ];
    }

    public function provideSimpleStructWithArrayProperty(): Generator
    {
        $code = <<<'CODE'
declare(strict_types=1);

namespace Example;

struct SimpleStruct
{
	array $value;
}

CODE;

        yield [
            $code,
            [
                StmtDeclare::enforceStrictTypes(),
                new StmtNamespace(
                    new TokenName('Example'),
                    [
                        new StmtStruct(
                            new TokenName('SimpleStruct'),
                            null,
                            [],
                            [
                                new StmtProperty(new TokenString('array'), new TokenVariable('value')),
                            ]
                        ),
                    ]
                ),
            ],
        ];
    }

    public function provideSimpleStructWithNullableIntProperty(): Generator
    {
        $code = <<<'CODE'
declare(strict_types=1);

namespace Example;

struct SimpleStruct
{
	?int $value;
}

CODE;

        yield [
            $code,
            [
                StmtDeclare::enforceStrictTypes(),
                new StmtNamespace(
                    new TokenName('Example'),
                    [
                        new StmtStruct(
                            new TokenName('SimpleStruct'),
                            null,
                            [],
                            [
                                new StmtProperty(new TokenString('?int'), new TokenVariable('value')),
                            ]
                        ),
                    ]
                ),
            ],
        ];
    }

    public function provideSimpleStructWithObjectProperty(): Generator
    {
        $code = <<<'CODE'
declare(strict_types=1);

namespace Example;

struct SimpleStruct
{
	\stdClass $value;
}

CODE;

        yield [
            $code,
            [
                StmtDeclare::enforceStrictTypes(),
                new StmtNamespace(
                    new TokenName('Example'),
                    [
                        new StmtStruct(
                            new TokenName('SimpleStruct'),
                            null,
                            [],
                            [
                                new StmtProperty(new TokenString('\stdClass'), new TokenVariable('value')),
                            ]
                        ),
                    ]
                ),
            ],
        ];
    }

    public function provideSimpleStructWithMultipleIntegerProperties(): Generator
    {
        $code = <<<'CODE'
declare(strict_types=1);

namespace Example;

struct SimpleStruct
{
	int $value1;
	int $value2;
}

CODE;

        yield [
            $code,
            [
                StmtDeclare::enforceStrictTypes(),
                new StmtNamespace(
                    new TokenName('Example'),
                    [
                        new StmtStruct(
                            new TokenName('SimpleStruct'),
                            null,
                            [],
                            [
                                new StmtProperty(new TokenString('int'), new TokenVariable('value1')),
                                new StmtProperty(new TokenString('int'), new TokenVariable('value2')),
                            ]
                        ),
                    ]
                ),
            ],
        ];
    }
}
