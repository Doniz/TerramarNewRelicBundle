<?php

namespace Terramar\Bundle\NewRelicBundle\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Terramar\Bundle\NewRelicBundle\Manager\ManagerInterface;

class RequestLifecycleSubscriber implements EventSubscriberInterface
{
    /**
     * Constructor
     *
     * @param ManagerInterface $manager
     */
    public function __construct(ManagerInterface $manager)
    {
        $this->manager = $manager;
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

        $this->manager->setTransactionName($request->get('_route'));
    }

    public static function getSubscribedEvents()
    {
        return array('kernel.controller' => 'onKernelController');
    }
}
