<?php

declare(strict_types=1);

namespace Tests\Typhped\Tokenizer;

use Typhped\Tokenizer\Manual\TokenAssignement;
use Typhped\Tokenizer\Manual\TokenClass;
use Typhped\Tokenizer\Manual\TokenDeclare;
use Typhped\Tokenizer\Manual\TokenGeneric;
use Typhped\Tokenizer\Manual\TokenLNumber;
use Typhped\Tokenizer\Manual\TokenNamespace;
use Typhped\Tokenizer\Manual\TokenOpenTag;
use Typhped\Tokenizer\Manual\TokenString;
use Typhped\Tokenizer\Manual\TokenWhitespace;
use Typhped\Tokenizer\TokenCollection;

/**
 * @todo: Reason this class exists
 */
class PhpClassProvider
{
    public static function provideJustOpenTag(): array
    {
        $code = <<<'CODE'
<?php
CODE;

        $expected = new TokenCollection([new TokenOpenTag('<?php')]);

        return [$code, $expected];
    }

    public static function provideSimpleClass(): array
    {
        $code = <<<'CODE'
<?php 
namespace Example; 
class SimpleClass
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
            new TokenClass(),
            new TokenWhitespace(' '),
            new TokenString('SimpleClass'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }

    public static function provideSimpleClassWithStrictDeclaration(): array
    {
        $code = <<<'CODE'
<?php

declare(strict_types=1);

namespace Example;

class SimpleClass
{
}
CODE;

        $expected = new TokenCollection([
            new TokenOpenTag('<?php'),
            new TokenWhitespace("\n\n"),
            new TokenDeclare(),
            new TokenGeneric('('),
            new TokenString('strict_types'),
            new TokenAssignement(),
            new TokenLNumber(1),
            new TokenGeneric(')'),
            new TokenGeneric(';'),
            new TokenWhitespace("\n\n"),
            new TokenNamespace(),
            new TokenWhitespace(' '),
            new TokenString('Example'),
            new TokenGeneric(';'),
            new TokenWhitespace("\n\n"),
            new TokenClass(),
            new TokenWhitespace(' '),
            new TokenString('SimpleClass'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }

    public static function provideChildClass(): array
    {
        $code = <<<'CODE'
<?php

namespace Example;

class ChildClass extends \stdClass
{
}
CODE;

        $expected = new TokenCollection([
            new TokenOpenTag('<?php'),
            new TokenWhitespace("\n\n"),
            new TokenNamespace(),
            new TokenWhitespace(' '),
            new TokenString('Example'),
            new TokenGeneric(';'),
            new TokenWhitespace("\n\n"),
            new TokenClass(),
            new TokenWhitespace(' '),
            new TokenString('ChildClass'),
            new TokenWhitespace(' '),
            new TokenString('extends'),
            new TokenWhitespace(' '),
            new TokenString('\stdClass'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }

    public static function provideClassWithInterfaces(): array
    {
        $code = <<<'CODE'
<?php

namespace Example;

class InterfacedClass implements \JsonSerializable
{
}
CODE;

        $expected = new TokenCollection([
            new TokenOpenTag('<?php'),
            new TokenWhitespace("\n\n"),
            new TokenNamespace(),
            new TokenWhitespace(' '),
            new TokenString('Example'),
            new TokenGeneric(';'),
            new TokenWhitespace("\n\n"),
            new TokenClass(),
            new TokenWhitespace(' '),
            new TokenString('InterfacedClass'),
            new TokenWhitespace(' '),
            new TokenString('implements'),
            new TokenWhitespace(' '),
            new TokenString('\JsonSerializable'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }

    public static function provideChildClassWithInterfaces(): array
    {
        $code = <<<'CODE'
<?php

namespace Example;

class ChildInterfacedClass extends \stdClass implements \JsonSerializable
{
}
CODE;

        $expected = new TokenCollection([
            new TokenOpenTag('<?php'),
            new TokenWhitespace("\n\n"),
            new TokenNamespace(),
            new TokenWhitespace(' '),
            new TokenString('Example'),
            new TokenGeneric(';'),
            new TokenWhitespace("\n\n"),
            new TokenClass(),
            new TokenWhitespace(' '),
            new TokenString('ChildInterfacedClass'),
            new TokenWhitespace(' '),
            new TokenString('extends'),
            new TokenWhitespace(' '),
            new TokenString('\stdClass'),
            new TokenWhitespace(' '),
            new TokenString('implements'),
            new TokenWhitespace(' '),
            new TokenString('\JsonSerializable'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }

    public static function provideClassWithMultipleInterfaces(): array
    {
        $code = <<<'CODE'
<?php

namespace Example;

class InterfacedClass implements \JsonSerializable,AnotherInterface
{
}
CODE;

        $expected = new TokenCollection([
            new TokenOpenTag('<?php'),
            new TokenWhitespace("\n\n"),
            new TokenNamespace(),
            new TokenWhitespace(' '),
            new TokenString('Example'),
            new TokenGeneric(';'),
            new TokenWhitespace("\n\n"),
            new TokenClass(),
            new TokenWhitespace(' '),
            new TokenString('InterfacedClass'),
            new TokenWhitespace(' '),
            new TokenString('implements'),
            new TokenWhitespace(' '),
            new TokenString('\JsonSerializable'),
            new TokenGeneric(','),
            new TokenString('AnotherInterface'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }

    public static function provideChildClassWithMultipleInterfaces(): array
    {
        $code = <<<'CODE'
<?php

namespace Example;

class ChildInterfacedClass extends \stdClass implements \JsonSerializable,AnotherInterface
{
}
CODE;

        $expected = new TokenCollection([
            new TokenOpenTag('<?php'),
            new TokenWhitespace("\n\n"),
            new TokenNamespace(),
            new TokenWhitespace(' '),
            new TokenString('Example'),
            new TokenGeneric(';'),
            new TokenWhitespace("\n\n"),
            new TokenClass(),
            new TokenWhitespace(' '),
            new TokenString('ChildInterfacedClass'),
            new TokenWhitespace(' '),
            new TokenString('extends'),
            new TokenWhitespace(' '),
            new TokenString('\stdClass'),
            new TokenWhitespace(' '),
            new TokenString('implements'),
            new TokenWhitespace(' '),
            new TokenString('\JsonSerializable'),
            new TokenGeneric(','),
            new TokenString('AnotherInterface'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }

    public static function provideTwoClassesInOneNamespace(): array
    {
        $code = <<<'CODE'
<?php 
namespace Example; 
class FirstClass
{
}
class SecondClass
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
            new TokenClass(),
            new TokenWhitespace(' '),
            new TokenString('FirstClass'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
            new TokenWhitespace("\n"),
            new TokenClass(),
            new TokenWhitespace(' '),
            new TokenString('SecondClass'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }

    public static function provideThreeClassesInOneNamespace(): array
    {
        $code = <<<'CODE'
<?php 
namespace Example; 
class FirstClass
{
}
class SecondClass
{
}
class ThirdClass
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
            new TokenClass(),
            new TokenWhitespace(' '),
            new TokenString('FirstClass'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
            new TokenWhitespace("\n"),
            new TokenClass(),
            new TokenWhitespace(' '),
            new TokenString('SecondClass'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
            new TokenWhitespace("\n"),
            new TokenClass(),
            new TokenWhitespace(' '),
            new TokenString('ThirdClass'),
            new TokenWhitespace("\n"),
            new TokenGeneric('{'),
            new TokenWhitespace("\n"),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }

    public static function provideShortClass(): array
    {
        $code = <<<'CODE'
<?php 
namespace Example; 
class ShortClass{}
CODE;

        $expected = new TokenCollection([
            new TokenOpenTag('<?php'),
            new TokenWhitespace(" \n"),
            new TokenNamespace(),
            new TokenWhitespace(' '),
            new TokenString('Example'),
            new TokenGeneric(';'),
            new TokenWhitespace(" \n"),
            new TokenClass(),
            new TokenWhitespace(' '),
            new TokenString('ShortClass'),
            new TokenGeneric('{'),
            new TokenGeneric('}'),
        ]);

        return [$code, $expected];
    }
}
