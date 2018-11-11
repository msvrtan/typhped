<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;

class ParserContext implements Context
{
    /**
     * @Given PHP content is
     */
    public function phpContentIs(PyStringNode $string): void
    {
        echo $string->getRaw();
        //throw new PendingException($string->getRaw());
    }

    /**
     * @When parser parses it
     */
    public function parserParsesIt(): void
    {
        //throw new PendingException();
    }

    /**
     * @Then parsed output is:
     */
    public function parsedOutputIs(PyStringNode $string): void
    {
        echo $string->getRaw();
        //throw new PendingException($string->getRaw());
    }
}
