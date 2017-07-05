<?php

namespace ViberBotDemoBundle\Chat\Activity;

use GFB\ChatBotBundle\Activity;
use GFB\ChatBotBundle\Annotation as GFBChatBot;

class ProductActivity extends Activity
{
    /**
     * @GFBChatBot\WaitFor("next")
     */
    public function showProducts()
    {
        echo 'some products list';
    }
}