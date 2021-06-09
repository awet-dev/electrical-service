<?php


namespace App\EventListener;


use App\Entity\Attendance;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class AttendanceListener implements EventSubscriberInterface
{

    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setUser']
        ];
    }

    public function setUser(BeforeEntityPersistedEvent $event )
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof Attendance) {
            $entity->setUser($this->security->getUser());
        }
    }
}