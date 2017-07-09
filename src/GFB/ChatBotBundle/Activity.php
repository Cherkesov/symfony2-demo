<?php

namespace GFB\ChatBotBundle;

use GFB\ChatBotBundle\Foundation\RedirectResponse;

class Activity
{
    /**
     * @param string $activityName
     * @return RedirectResponse
     * @throws \Exception
     */
    public function redirect($activityName)
    {
        $activity = new $activityName();
        if (!$activity instanceof Activity) {
            throw new \Exception($activityName . ' is not activity!');
        }

        return new RedirectResponse($activityName);
    }
}