<?php

declare(strict_types=1);

namespace Typhped\Tokenizer\Regex;

class Token
{
    /** @var string */
    private $pattern;

    /** @var string */
    private $replacement;

    /** @var string */
    private $options;

    public function __construct(string $pattern, string $replacement, string $options)
    {
        $this->pattern     = $pattern;
        $this->replacement = $replacement;
        $this->options     = $options;
    }

    public function getPattern(): string
    {
        return '/'.$this->pattern.'/'.$this->options;
    }

    public function getReplacement(): string
    {
        return $this->replacement;
    }
}
