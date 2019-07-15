<?php

declare(strict_types=1);

namespace Tests\Typhped\Tokenizer;

use Typhped\Structure\Token\TokenVariable;
use Typhped\Tokenizer\Manual\TokenGeneric;
use Typhped\Tokenizer\Manual\TokenNamespace;
use Typhped\Tokenizer\Manual\TokenOpenTag;
use Typhped\Tokenizer\Manual\TokenString;
use Typhped\Tokenizer\Manual\TokenStruct;
use Typhped\Tokenizer\Manual\TokenWhitespace;
use Typhped\Tokenizer\TokenCollection;

class TyPHPedClassProvider
{
    public static function provideSimpleStruct(): array
    {
        $code = <<<'CODE'
<?php 
namespace Example; 
struct SimpleStruct
{
}
CODE;

        $expected = new TokenCollection([
            new TokenOpenTag('<?php'),
            new TokenWhitespace(" \n"),
            new TokenNamespace(),
            new TokenWhitespace(' '),
            new TokenString('Example'),
            new TokenGeneric(';'),
            new TokenWhitespace(" \n"),
            new TokenStruct(),
            new TokenWhitespace(' '),
            new TokenString('SimpleStruct'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }

    public static function provideSimpleStructWithIntegerProperty(): array
    {
        $code = <<<'CODE'
<?php 
namespace Example; 
struct SimpleStruct
{
    int $value;
}
CODE;

        $expected = new TokenCollection([
            new TokenOpenTag('<?php'),
            new TokenWhitespace(" \n"),
            new TokenNamespace(),
            new TokenWhitespace(' '),
            new TokenString('Example'),
            new TokenGeneric(';'),
            new TokenWhitespace(" \n"),
            new TokenStruct(),
            new TokenWhitespace(' '),
            new TokenString('SimpleStruct'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n    "),
            new TokenString('int'),
            new TokenWhitespace(' '),
            new TokenVariable('value'),
            new TokenGeneric(';'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }

    public static function provideSimpleStructWithArrayProperty(): array
    {
        $code = <<<'CODE'
<?php 
namespace Example; 
struct SimpleStruct
{
    array $value;
}
CODE;

        $expected = new TokenCollection([
            new TokenOpenTag('<?php'),
            new TokenWhitespace(" \n"),
            new TokenNamespace(),
            new TokenWhitespace(' '),
            new TokenString('Example'),
            new TokenGeneric(';'),
            new TokenWhitespace(" \n"),
            new TokenStruct(),
            new TokenWhitespace(' '),
            new TokenString('SimpleStruct'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n    "),
            new TokenString('array'),
            new TokenWhitespace(' '),
            new TokenVariable('value'),
            new TokenGeneric(';'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }

    public static function provideSimpleStructWithNullableIntProperty(): array
    {
        $code = <<<'CODE'
<?php 
namespace Example; 
struct SimpleStruct
{
    ?int $value;
}
CODE;

        $expected = new TokenCollection([
            new TokenOpenTag('<?php'),
            new TokenWhitespace(" \n"),
            new TokenNamespace(),
            new TokenWhitespace(' '),
            new TokenString('Example'),
            new TokenGeneric(';'),
            new TokenWhitespace(" \n"),
            new TokenStruct(),
            new TokenWhitespace(' '),
            new TokenString('SimpleStruct'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n    "),
            new TokenString('?int'),
            new TokenWhitespace(' '),
            new TokenVariable('value'),
            new TokenGeneric(';'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }

    public static function provideSimpleStructWithObjectProperty(): array
    {
        $code = <<<'CODE'
<?php 
namespace Example; 
struct SimpleStruct
{
    \stdClass $value;
}
CODE;

        $expected = new TokenCollection([
            new TokenOpenTag('<?php'),
            new TokenWhitespace(" \n"),
            new TokenNamespace(),
            new TokenWhitespace(' '),
            new TokenString('Example'),
            new TokenGeneric(';'),
            new TokenWhitespace(" \n"),
            new TokenStruct(),
            new TokenWhitespace(' '),
            new TokenString('SimpleStruct'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n    "),
            new TokenString('\stdClass'),
            new TokenWhitespace(' '),
            new TokenVariable('value'),
            new TokenGeneric(';'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }

    public static function provideSimpleStructWithMultipleIntegerProperties(): array
    {
        $code = <<<'CODE'
<?php 
namespace Example; 
struct SimpleStruct
{
    int $value1;
    int $value2;
}
CODE;

        $expected = new TokenCollection([
            new TokenOpenTag('<?php'),
            new TokenWhitespace(" \n"),
            new TokenNamespace(),
            new TokenWhitespace(' '),
            new TokenString('Example'),
            new TokenGeneric(';'),
            new TokenWhitespace(" \n"),
            new TokenStruct(),
            new TokenWhitespace(' '),
            new TokenString('SimpleStruct'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n    "),
            new TokenString('int'),
            new TokenWhitespace(' '),
            new TokenVariable('value1'),
            new TokenGeneric(';'),
            new TokenWhitespace("\n    "),
            new TokenString('int'),
            new TokenWhitespace(' '),
            new TokenVariable('value2'),
            new TokenGeneric(';'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }
}
