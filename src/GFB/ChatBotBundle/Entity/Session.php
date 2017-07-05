<?php

namespace GFB\ChatBotBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="gfb_chat_bot__session")
 */
class Session
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    private $user;

    private $activity;
}