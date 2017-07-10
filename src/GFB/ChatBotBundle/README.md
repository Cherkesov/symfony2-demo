$ composer require gfb/chat-bot-bundle


Set user class:

    doctrine:
        ...
        orm:
            ...
            resolve_target_entities:
                GFB\ChatBotBundle\Entity\UserInterface: ViberBotDemoBundle\Entity\User

