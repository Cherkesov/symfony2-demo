<?php

namespace GFB\ChatBotBundle\Routing;

use Doctrine\Common\Annotations\CachedReader;
use GFB\ChatBotBundle\Activity;
use GFB\ChatBotBundle\Annotation\WaitFor;

class Router
{
    /** @var CachedReader */
    private $annotationReader;

    /** @var array */
    private $activities;

    /**
     * Router constructor.
     * @param CachedReader $annotationReader
     * @param array $activities
     */
    public function __construct(CachedReader $annotationReader, array $activities = [])
    {
        $this->annotationReader = $annotationReader;
        $this->activities = $activities;
    }

    public function resolve($query)
    {
        foreach ($this->activities as $className) {
            /** @var Activity $activity */
            $activity = new $className();

            $object = new \ReflectionObject($activity);

            foreach ($object->getMethods() as $method) {
                foreach ($this->annotationReader->getMethodAnnotations($method) as $annotation) {
                    if ($annotation instanceof WaitFor && $annotation->getPhrase() == $query) {
                        $method->invoke($activity, []);
                    }
                }
            }
        }
    }

    public function loadActivities(array $activities)
    {
        foreach ($activities as $activity) {
            if (is_string($activity) && (new $activity()) instanceof Activity) {
                $this->activities[] = $activity;
            }

            if (is_object($activity) && $activity instanceof Activity) {
                $this->activities[] = get_class($activity);
            }
        }

        return $this;
    }
}