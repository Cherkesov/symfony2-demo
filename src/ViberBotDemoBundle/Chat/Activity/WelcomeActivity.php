<?php

namespace ViberBotDemoBundle\Chat\Activity;

use GFB\ChatBotBundle\Activity;
use GFB\ChatBotBundle\Matcher as GFBChatMatcher;

class WelcomeActivity extends Activity
{
    /**
     * @GFBChatMatcher\Verbatim("category")
     */
    public function categoryAction()
    {
        return $this->redirect(CategorySelectActivity::class);
    }

    /**
     * @GFBChatMatcher\Any()
     */
    public function helloAction()
    {
        return "Hello!\nCan I help you?\n=))\n"
            . "Please write \"category\" if you want to select product's category.";
    }
}