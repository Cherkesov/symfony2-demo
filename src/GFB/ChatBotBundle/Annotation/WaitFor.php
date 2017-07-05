<?php

namespace GFB\ChatBotBundle\Annotation;

/**
 * @Annotation
 * @Target({"METHOD"})
 */
class WaitFor
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
}