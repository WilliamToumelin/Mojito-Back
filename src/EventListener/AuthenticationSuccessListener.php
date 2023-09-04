<?php
namespace App\EventListener;

use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

// src/App/EventListener/AuthenticationSuccessListener.php


/**
 * @param AuthenticationSuccessEvent $event
 */

class AuthenticationSuccessListener
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $data['data'] = array(
            'id' => $user->getId(),
            'pseudonym' => $user->getPseudonym(),
        );

        $event->setData($data);
    }
}