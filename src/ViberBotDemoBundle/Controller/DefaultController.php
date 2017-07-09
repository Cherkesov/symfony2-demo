<?php

namespace ViberBotDemoBundle\Controller;

use GFB\ChatBotBundle\Entity\Session;
use GFB\ChatBotBundle\Entity\UserInterface;
use GFB\ChatBotBundle\Foundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ViberBotDemoBundle\Chat\Activity\CategorySelectActivity;
use ViberBotDemoBundle\Chat\Activity\ProductActivity;
use ViberBotDemoBundle\Chat\Activity\WelcomeActivity;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @param Request $request
     */
    public function indexAction(Request $request)
    {
        $query = $request->query->get('query');
        $phone = $request->query->get('phone');
        preg_replace('/\D/', '', $phone);

        $em = $this->getDoctrine()->getManager();

        $userClass = $this->resolveClass(UserInterface::class);
        $user = $this->getDoctrine()
            ->getRepository($userClass)
            ->find($phone);
        if (null == $user) {
            $user = new $userClass();
            $user->setId($phone);
            $em->persist($user);
            $em->flush();
        }

        $session = $this->getDoctrine()
            ->getRepository(Session::class)
            ->findOneBy(['user' => $user]);
        if (null == $session) {
            $session = new Session();
            $defaultActivity = $this->getParameter('gfb_chat_bot.config.welcome_activity');
            $session
                ->setActivityName($defaultActivity)
                ->setUser($user);
            $em->persist($session);
            $em->flush();
        }

        $botRequest = new \GFB\ChatBotBundle\Foundation\Request();
        $botRequest
            ->setQuery($query)
            ->setSession($session);

        $router = $this->get('gfb_chat_bot.router');
        $response = $router->resolve($botRequest);

        if ($response instanceof RedirectResponse) {
            $session->setActivityName($response->getActivityName());
            $em->merge($session);
            $em->flush();

            $botRequest->setQuery(null);
            $response = $router->resolve($botRequest);
        }

        return new Response(
            '<pre>'
            . print_r($response, true)
            . '</pre>'
        );
    }

    /**
     * @param string $className
     * @return string
     */
    private function resolveClass($className)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $metadata = $entityManager->getClassMetadata($className);

        return $metadata->getName();
    }
}
