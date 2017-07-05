<?php

namespace GFB\ChatBotBundle\Annotation;

/**
 * @Annotation
 * @Target({"METHOD"})
 */
class Action
{
    /**
     * @var string
     *
     * @Required
     */
    public $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}