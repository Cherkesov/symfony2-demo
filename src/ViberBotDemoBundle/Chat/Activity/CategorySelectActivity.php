<?php

namespace ViberBotDemoBundle\Chat\Activity;

use GFB\ChatBotBundle\Activity;
use GFB\ChatBotBundle\Annotation as GFBChatBot;

class CategorySelectActivity extends Activity
{
    public function startAction()
    {
        echo 'Please, select category!';

        return $this->redirect('wildfowl');
    }

    /**
     * @GFBChatBot\WaitFor("category")
     */
    public function waitUserSelection()
    {
        die('Method ' . __METHOD__ . ' catch it!');
    }
}