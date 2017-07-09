<?php

namespace GFB\ChatBotBundle\Matcher;

use GFB\ChatBotBundle\Foundation\Request;
use GFB\ChatBotBundle\MatcherInterface;

/**
 * @Annotation
 * @Target({"METHOD"})
 */
class Verbatim implements MatcherInterface
{
    /**
     * @var string
     *
     * @Required
     */
    public $phrase;

    /**
     * @return string
     */
    public function getPhrase()
    {
        return $this->phrase;
    }

    /**
     * @param mixed $data
     * @return boolean
     */
    public function isSuitable($data)
    {
        return $data == $this->phrase;
    }

    /**
     * @param Request $request
     */
    public function decorateRequest(Request $request)
    {
        //
    }
}