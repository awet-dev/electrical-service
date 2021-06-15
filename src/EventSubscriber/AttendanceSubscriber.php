<?php

namespace App\EventSubscriber;

use App\Entity\Attendance;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class AttendanceSubscriber implements EventSubscriberInterface
{
    private Security $security;

    /**
     * AttendanceSubscriber constructor.
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => 'onSetAttendance',
        ];
    }

    public function onSetAttendance(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof Attendance) {
            $entity->setUser($this->security->getUser());
        }
    }
}
