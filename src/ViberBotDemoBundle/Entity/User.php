<?php

namespace ViberBotDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use GFB\ChatBotBundle\Entity\UserInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="viber_bot_demo__user")
 */
class User implements UserInterface
{
    /**
     * @var string
     *
     * @ORM\Id()
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}