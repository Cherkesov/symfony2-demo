<?php

namespace GFB\ChatBotBundle\Routing;

use Doctrine\Common\Annotations\CachedReader;
use GFB\ChatBotBundle\Activity;
use GFB\ChatBotBundle\Annotation\RegexMatch;
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

                        return;
                    }

                    if ($annotation instanceof RegexMatch
                        && preg_match($annotation->getExpression(), $query, $matches)
                    ) {
                        if (count($matches) > 1) {
                            $args = &$matches;
                            unset($args[0]);
                            $args = array_values($args);
                            $method->invokeArgs($activity, $args);
                        } else {
                            $method->invoke($activity, []);
                        }

                        return;
                    }

                }
            }
        }

        throw new \Exception('Activity not found!');
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