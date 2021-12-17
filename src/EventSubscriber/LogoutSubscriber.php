<?php

namespace App\EventSubscriber;

use App\Entity\Coworker;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\LogoutEvent;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;


class LogoutSubscriber implements EventSubscriberInterface
{
    private $flashBag;

    public function __construct(FlashBagInterface $flashBag)
    {
        $this->flashBag = $flashBag;
    }

    public function onLogoutEvent(LogoutEvent $event)
    {
        /** @var Coworker */
        $coworker = $event->getToken()->getUser();
        $this->flashBag->add('success', $coworker->getFirstName() . ', you have been logged out successfully'); 
    }

    public static function getSubscribedEvents()
    {
        return [
            LogoutEvent::class => 'onLogoutEvent',
        ];
    }
}
