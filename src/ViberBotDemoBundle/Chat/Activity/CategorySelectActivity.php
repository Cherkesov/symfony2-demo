<?php

namespace ViberBotDemoBundle\Chat\Activity;

use GFB\ChatBotBundle\Activity;
use GFB\ChatBotBundle\Matcher as GFBChatMatcher;

class CategorySelectActivity extends Activity
{
    /**
     * @GFBChatMatcher\Verbatim("exit")
     */
    public function exitAction()
    {
        return $this->redirect(WelcomeActivity::class);
    }

    /**
     * @GFBChatMatcher\Regex(expression="/^([\d]+)$/")
     *
     * @param integer $id
     * @return string
     */
    public function waitUserSelectionAction($id)
    {
        return 'Sorry, but you specify non-existent category ID - ' . $id . '.';
    }

    /**
     * @GFBChatMatcher\Regex(expression="/^([\w\s]+)$/u")
     *
     * @param string $text
     * @return string
     */
    public function getTextAction($text)
    {
        return 'Sorry, but I can not found category with name "' . $text . '".';
    }

    /**
     * @GFBChatMatcher\Any()
     */
    public function helpAction()
    {
        return "Now you can select category with 2 methods:\n"
            . "  1) You should scroll list of categories and enter selected categories ID\n"
            . "  2) You can write category name and system try to found something similar\n\n"
            . "You always can return to start of product selecting. You should write \"exit\" and we will start from the beginning ^__^";
    }
}