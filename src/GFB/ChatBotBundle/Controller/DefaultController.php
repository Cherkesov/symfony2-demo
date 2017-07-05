<?php

namespace GFB\ChatBotBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GFBChatBotBundle:Default:index.html.twig');
    }
}
