<?php

namespace GFB\ChatBotBundle\Foundation;

class RedirectResponse
{
    /** @var string */
    private $activityName;

    /**
     * RedirectResponse constructor.
     * @param string $activityName
     */
    public function __construct($activityName)
    {
        $this->activityName = $activityName;
    }

    /**
     * @return string
     */
    public function getActivityName()
    {
        return $this->activityName;
    }

    /**
     * @param string $activityName
     * @return RedirectResponse
     */
    public function setActivityName($activityName)
    {
        $this->activityName = $activityName;

        return $this;
    }
}