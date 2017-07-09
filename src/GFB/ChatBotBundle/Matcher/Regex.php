<?php

namespace GFB\ChatBotBundle\Matcher;

use GFB\ChatBotBundle\Foundation\Request;
use GFB\ChatBotBundle\MatcherInterface;

/**
 * @Annotation
 * @Target({"METHOD"})
 */
class Regex implements MatcherInterface
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

    /**
     * @param mixed $data
     * @return boolean
     */
    public function isSuitable($data)
    {
        return preg_match($this->expression, $data, $matches);
    }

    public function decorateRequest(Request $request)
    {
        preg_match($this->expression, $request->getQuery(), $matches);

        if (count($matches) <= 1) {
            return;
        }
        $params = &$matches;
        unset($params[0]);
        $params = array_values($params);

//        print_r($params);

        foreach ($params as $key => $param) {
            $request->setParameter($key, $param);
        }
    }
}