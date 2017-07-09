<?php

namespace GFB\ChatBotBundle\Foundation;

use GFB\ChatBotBundle\Entity\Session;
use GFB\ChatBotBundle\Entity\UserInterface;

class Request
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var string
     */
    private $query;

    /**
     * @var array
     */
    private $parameters = [];

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->session->getUser();
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param Session $session
     * @return $this
     */
    public function setSession(Session $session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param string $query
     * @return $this
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     * @return $this
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * @param string $parameter
     * @param $value
     */
    public function setParameter($parameter, $value)
    {
        $this->parameters[$parameter] = $value;
    }

    /**
     * @param string $parameter
     * @return mixed
     */
    public function getParameter($parameter)
    {
        return $this->parameters[$parameter];
    }

    /**
     * @param string $parameter
     * @return boolean
     */
    public function hasParameter($parameter)
    {
        return array_key_exists($parameter, $this->parameters);
    }
}