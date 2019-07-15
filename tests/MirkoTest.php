<?php

declare(strict_types=1);

namespace Tests;

use Generator;
use PhpParser\Error;
use PhpParser\NodeDumper;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter;
use PHPUnit\Framework\TestCase;

class MirkoTest extends TestCase
{
    /**
     * @dataProvider provideCode
     */
    public function testNikicParserOutput(string $code): void
    {
        //$this->markTestSkipped('Skipping for now..');

        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        try {
            /** @var \PhpParser\Node[] $ast */
            $ast = $parser->parse($code);
        } catch (Error $error) {
            echo "Parse error: {$error->getMessage()}\n";

            return;
        }

        $dumper = new NodeDumper();
        echo $dumper->dump($ast)."\n";

        $prettyPrinter = new PrettyPrinter\Standard();
        echo $prettyPrinter->prettyPrintFile($ast);

        //var_dump(token_get_all($code));
    }

    public function provideCode(): Generator
    {
        yield[file_get_contents(__DIR__.'/../src/Example/SimpleClass.php')];
        //yield[file_get_contents(__DIR__.'/../src/Example/JsonSerializableClass.php')];
        //yield[file_get_contents(__DIR__.'/../src/Example/JsonSerializableClassWithImports.php')];
    }
}
