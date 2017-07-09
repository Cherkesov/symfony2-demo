<?php

namespace GFB\ChatBotBundle;

use GFB\ChatBotBundle\Foundation\Request;

interface MatcherInterface
{
    /**
     * @param mixed $data
     * @return boolean
     */
    public function isSuitable($data);

    /**
     * @param Request $request
     * @return void
     */
    public function decorateRequest(Request $request);
}