<?php

namespace GFB\ChatBotBundle\Matcher;

use GFB\ChatBotBundle\Foundation\Request;
use GFB\ChatBotBundle\MatcherInterface;

/**
 * @Annotation
 * @Target({"METHOD"})
 */
class Any implements MatcherInterface
{
    /**
     * @param mixed $data
     * @return boolean
     */
    public function isSuitable($data)
    {
        return true;
    }

    /**
     * @param Request $request
     */
    public function decorateRequest(Request $request)
    {
        //
    }
}