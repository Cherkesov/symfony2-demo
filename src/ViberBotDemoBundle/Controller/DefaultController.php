<?php

namespace ViberBotDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ViberBotDemoBundle\Chat\Activity\CategorySelectActivity;
use ViberBotDemoBundle\Chat\Activity\WelcomeActivity;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $query = $request->query->get('query');
        $this->get('gfb_chat_bot.router')
            ->loadActivities(
                [
                    WelcomeActivity::class,
                    CategorySelectActivity::class,
                ]
            )
            ->resolve($query);

        return $this->render('ViberBotDemoBundle:Default:index.html.twig');
    }
}
