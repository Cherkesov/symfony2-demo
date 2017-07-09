<?php

namespace GFB\ChatBotBundle\Tests\Matcher;

use GFB\ChatBotBundle\Matcher as GFBChatMatcher;
use PHPUnit\Framework\TestCase;

class RegexTest extends TestCase
{
    public function testSuitable()
    {
        $regexMatcher = new GFBChatMatcher\Regex();
        $regexMatcher->expression = '/^([\w\s]+)$/u';

        $this->assertTrue((boolean)$regexMatcher->isSuitable('Helloдичь'), '');
    }
}
