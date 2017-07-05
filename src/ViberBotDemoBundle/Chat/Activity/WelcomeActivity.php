<?php

namespace ViberBotDemoBundle\Chat\Activity;

use GFB\ChatBotBundle\Activity;
use GFB\ChatBotBundle\Annotation as GFBChatBot;

class WelcomeActivity extends Activity
{
    /**
     * @GFBChatBot\WaitFor("hello")
     */
    public function helloAction()
    {
        die('Method ' . __METHOD__ . ' catch it!');
    }
}