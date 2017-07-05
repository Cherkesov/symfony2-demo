<?php

namespace GFB\ChatBotBundle\Annotation;

/**
 * @Annotation
 * @Target({"METHOD"})
 */
class RegexMatch
{
    /**
     * @var string
     *
     * @Required()
     */
    public $expression;

    /**
     * @return string
     */
    public function getExpression()
    {
        return $this->expression;
    }
}