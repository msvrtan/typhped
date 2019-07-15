<?php

declare(strict_types=1);

namespace Tests\Typhped\Tokenizer\ManualTokenizer;

use Generator;
use PHPUnit\Framework\TestCase;
use Tests\Typhped\Tokenizer\TyPHPedClassProvider;
use Typhped\Tokenizer\ManualTokenizer;
use Typhped\Tokenizer\TokenCollection;

/**
 * @covers \Typhped\Tokenizer\ManualTokenizer
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class SimpleStructTest extends TestCase
{
    /** @var ManualTokenizer */
    private $tokenizer;

    public function setUp(): void
    {
        $this->tokenizer = new ManualTokenizer();
    }

    /**
     * @dataProvider provideTyPHPedStructures
     */
    public function testTokenize(string $code, TokenCollection $expected): void
    {
        // Act
        $result = $this->tokenizer->tokenize($code);

        // Assert
        self::assertEquals($expected, $result);
    }

    public function provideTyPhpedStructures(): Generator
    {
        yield TyPHPedClassProvider::provideSimpleStruct();
        yield TyPHPedClassProvider::provideSimpleStructWithIntegerProperty();
        yield TyPHPedClassProvider::provideSimpleStructWithArrayProperty();
        yield TyPHPedClassProvider::provideSimpleStructWithNullableIntProperty();
        yield TyPHPedClassProvider::provideSimpleStructWithObjectProperty();
        yield TyPHPedClassProvider::provideSimpleStructWithMultipleIntegerProperties();
    }
}
