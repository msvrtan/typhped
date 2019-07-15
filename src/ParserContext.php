<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Typhped\Converter\NikicConverter;
use Typhped\Parser\SimpleParser;
use Typhped\Printer\NikicPrinter;
use Typhped\Tokenizer\ManualTokenizer;
use Typhped\Transpiler\SimpleTranspiler;
use Webmozart\Assert\Assert;

class ParserContext implements Context
{
    /** @var string */
    private $input = '';

    /** @var string */
    private $output = '';

    /**
     * @Given PHP content is
     * @Given tyPHPed content is
     */
    public function phpContentIs(PyStringNode $input): void
    {
        $this->input = $input->getRaw();
    }

    /**
     * @When I convert it
     */
    public function iConvertIt(): void
    {
        $transpiler = new SimpleTranspiler(
            new SimpleParser(new ManualTokenizer()),
            new NikicConverter(),
            new NikicPrinter()
        );

        $this->output = $transpiler->transpile($this->input);
    }

    /**
     * @Then PHP output is:
     */
    public function phpOutputIs(PyStringNode $expected): void
    {
        Assert::eq($this->output, $expected->getRaw());
    }
}
