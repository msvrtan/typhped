<?php

declare(strict_types=1);

namespace Tests\Typhped\Parser\SimpleParser;

use Generator;
use PHPUnit\Framework\TestCase;
use Typhped\Parser\SimpleParser;
use Typhped\Structure\Statement\StmtClass;
use Typhped\Structure\Statement\StmtDeclare;
use Typhped\Structure\Statement\StmtNamespace;
use Typhped\Structure\Token\TokenName;
use Typhped\Tokenizer\ManualTokenizer;

/**
 * @covers \Typhped\Parser\SimpleParser
 */
class SimpleClassTest extends TestCase
{
    /**
     * @dataProvider provideSimpleClass
     * @dataProvider provideChildClass
     * @dataProvider provideChildClassWithInterfaces
     * @dataProvider provideClassWithInterface
     * @dataProvider provideChildClassWithMultipleInterfaces
     * @dataProvider provideClassWithMultipleInterfaces
     */
    public function testParse(string $code, array $expected): void
    {
        // Act
        $parser = new SimpleParser(new ManualTokenizer());
        $result = $parser->parse($code);

        // Assert

        self::assertEquals($expected, $result);
    }

    public function provideSimpleClass(): Generator
    {
        $code = <<<'CODE'
declare(strict_types=1);

namespace Example;

class SimpleClass
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
                        new StmtClass(new TokenName('SimpleClass'), null, []),
                    ]
                ),
            ],
        ];
    }

    public function provideChildClass(): Generator
    {
        $code = <<<'CODE'
declare(strict_types=1);

namespace Example;

class ChildClass extends \stdClass
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
                        new StmtClass(new TokenName('ChildClass'), new TokenName('\stdClass'), []),
                    ]
                ),
            ],
        ];
    }

    public function provideChildClassWithInterfaces(): Generator
    {
        $code = <<<'CODE'
declare(strict_types=1);

namespace Example;

class ChildWithInterfaceClass extends \stdClass implements \JsonSerializable
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
                        new StmtClass(
                            new TokenName('ChildWithInterfaceClass'),
                            new TokenName('\stdClass'),
                            [new TokenName('\JsonSerializable')]
                        ),
                    ]
                ),
            ],
        ];
    }

    public function provideClassWithInterface(): Generator
    {
        $code = <<<'CODE'
declare(strict_types=1);

namespace Example;

class WithInterfaceClass implements \JsonSerializable
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
                        new StmtClass(
                            new TokenName('WithInterfaceClass'),
                            null,
                            [new TokenName('\JsonSerializable')]
                        ),
                    ]
                ),
            ],
        ];
    }

    public function provideChildClassWithMultipleInterfaces(): Generator
    {
        $code = <<<'CODE'
declare(strict_types=1);

namespace Example;

class ChildWithInterfacesClass extends \stdClass implements \JsonSerializable,\Immutable
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
                        new StmtClass(
                            new TokenName('ChildWithInterfacesClass'),
                            new TokenName('\stdClass'),
                            [
                                new TokenName('\JsonSerializable'),
                                new TokenName('\Immutable'),
                            ]
                        ),
                    ]
                ),
            ],
        ];
    }

    public function provideClassWithMultipleInterfaces(): Generator
    {
        $code = <<<'CODE'
declare(strict_types=1);

namespace Example;

class WithInterfaces implements \JsonSerializable,\Immutable
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
                        new StmtClass(
                            new TokenName('WithInterfaces'),
                            null,
                            [
                                new TokenName('\JsonSerializable'),
                                new TokenName('\Immutable'),
                            ]
                        ),
                    ]
                ),
            ],
        ];
    }
}
