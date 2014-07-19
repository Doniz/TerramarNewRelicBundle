<?php

namespace Terramar\Bundle\NewRelicBundle\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Terramar\Bundle\NewRelicBundle\Driver\DriverInterface;

class RequestLifecycleSubscriber implements EventSubscriberInterface
{
    /**
     * Constructor
     *
     * @param DriverInterface $driver
     */
    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Updates the transaction name with the current URI
     *
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $request = $event->getRequest();

        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        $this->driver->setTransactionName($request->get('_route'));
    }

    public static function getSubscribedEvents()
    {
        return array(KernelEvents::CONTROLLER => 'onKernelController');
    }
}
