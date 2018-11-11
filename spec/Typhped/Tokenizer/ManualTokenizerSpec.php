<?php

declare(strict_types=1);

namespace spec\Typhped\Tokenizer;

use PhpSpec\ObjectBehavior;
use Typhped\Tokenizer\ManualTokenizer;

class ManualTokenizerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ManualTokenizer::class);
    }
}
