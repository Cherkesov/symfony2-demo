<?php

namespace ViberBotDemoBundle\Chat\Activity;

use GFB\ChatBotBundle\Activity;
use GFB\ChatBotBundle\Annotation as GFBChatBot;

class CategorySelectActivity extends Activity
{
    public function startAction()
    {
        echo 'Please, select category!';

//        return $this->redirect('wildfowl');
    }

    /**
     * @param string $text
     *
     * @GFBChatBot\Action("viber_bot_demo__category__get_text")
     * @GFBChatBot\RegexMatch(expression="/^([\w\s]+)$/")
     */
    public function getTextAction($text)
    {
        die('Method ' . __METHOD__ . ' catch it! Get some text - ' . $text);
//        $this->redirect(ProductActivity::class);
    }

    /**
     * @param integer $id
     *
     * @GFBChatBot\Action("viber_bot_demo__category__selection")
     * @GFBChatBot\RegexMatch(expression="/^([\d]+)$/")
     */
    public function waitUserSelectionAction($id)
    {
        die('Method ' . __METHOD__ . ' catch it! Category ID = ' . $id);
//        $this->redirect(ProductActivity::class);
    }
}