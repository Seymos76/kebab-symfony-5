<?php


namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class FileHandlerSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['fileHandler', EventPriorities::PRE_DESERIALIZE]
        ];
    }

    public function fileHandler(ViewEvent $event)
    {
        $result = $event->getControllerResult();
        $request = $event->getRequest();
        dump('fileHandler request',$request);
    }
}
