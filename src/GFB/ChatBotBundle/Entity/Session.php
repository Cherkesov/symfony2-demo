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

    /**
     * @var UserInterface
     *
     * @ORM\ManyToOne(targetEntity="GFB\ChatBotBundle\Entity\UserInterface")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $activityName;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string
     */
    public function getActivityName()
    {
        return $this->activityName;
    }

    /**
     * @param string $activityName
     * @return $this
     */
    public function setActivityName($activityName)
    {
        $this->activityName = $activityName;

        return $this;
    }
}