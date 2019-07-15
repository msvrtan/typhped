<?php

declare(strict_types=1);

namespace Tests\Typhped\Tokenizer\ManualTokenizer;

use Generator;
use PHPUnit\Framework\TestCase;
use Tests\Typhped\Tokenizer\PhpClassProvider;
use Typhped\Tokenizer\ManualTokenizer;
use Typhped\Tokenizer\TokenCollection;

/**
 * @covers \Typhped\Tokenizer\ManualTokenizer
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class SimpleClassTest extends TestCase
{
    /**
     * @var ManualTokenizer
     */
    private $tokenizer;

    public function setUp(): void
    {
        $this->tokenizer = new ManualTokenizer();
    }

    /**
     * @dataProvider providePhpClasses
     */
    public function testTokenize(string $code, TokenCollection $expected): void
    {
        // Act
        $result = $this->tokenizer->tokenize($code);

        // Assert
        self::assertEquals($expected, $result);
    }

    public function providePhpClasses(): Generator
    {
        yield PhpClassProvider::provideJustOpenTag();
        yield PhpClassProvider::provideSimpleClass();
        yield PhpClassProvider::provideSimpleClassWithStrictDeclaration();
        yield PhpClassProvider::provideChildClass();
        yield PhpClassProvider::provideClassWithInterfaces();
        yield PhpClassProvider::provideChildClassWithInterfaces();
        yield PhpClassProvider::provideClassWithMultipleInterfaces();
        yield PhpClassProvider::provideChildClassWithMultipleInterfaces();
        yield PhpClassProvider::provideTwoClassesInOneNamespace();
        yield PhpClassProvider::provideThreeClassesInOneNamespace();
    }
}
