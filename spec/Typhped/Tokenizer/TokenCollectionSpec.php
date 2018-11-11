<?php

declare(strict_types=1);

namespace spec\Typhped\Tokenizer;

use PhpSpec\ObjectBehavior;
use Typhped\Tokenizer\TokenCollection;

class TokenCollectionSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith([]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(TokenCollection::class);
    }
}
