<?php

namespace GFB\ChatBotBundle\Routing;

use Doctrine\Common\Annotations\CachedReader;
use GFB\ChatBotBundle\Activity;
use GFB\ChatBotBundle\Foundation\Request;
use GFB\ChatBotBundle\MatcherInterface;

class Router
{
    /** @var CachedReader */
    private $annotationReader;

    /**
     * Router constructor.
     * @param CachedReader $annotationReader
     */
    public function __construct(CachedReader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function resolve(Request $request)
    {
        $className = $request->getSession()->getActivityName();
        /** @var Activity $activity */
        $activity = new $className();

        $object = new \ReflectionObject($activity);

        foreach ($object->getMethods() as $method) {
            foreach ($this->annotationReader->getMethodAnnotations($method) as $annotation) {

                $needUserRequest = count($method->getParameters())
                    && null != $method->getParameters()[0]->getClass()
                    && $method->getParameters()[0]->getClass()->getName() == Request::class;

                if ($annotation instanceof MatcherInterface
                    && $annotation->isSuitable($request->getQuery())
                ) {
                    $annotation->decorateRequest($request);

                    $arguments = [];
                    if ($needUserRequest) {
                        $arguments[] = $request;
                    }
                    $arguments = array_merge($arguments, $request->getParameters());

                    return $method->invokeArgs($activity, $arguments);
                }

            }
        }

        throw new \Exception('Activity not found!');
    }
}