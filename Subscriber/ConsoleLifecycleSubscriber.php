<?php

namespace Terramar\Bundle\NewRelicBundle\Subscriber;

use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Terramar\Bundle\NewRelicBundle\Driver\DriverInterface;

/**
 * Handles setting transaction name and background job information
 * 
 * This subscriber also tracks how long a command takes to execute
 */
class ConsoleLifecycleSubscriber implements EventSubscriberInterface
{
    private $timer;
    
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
     * @param ConsoleCommandEvent $event
     */
    public function onConsoleCommand(ConsoleCommandEvent $event)
    {
        $this->driver->setTransactionName($event->getCommand()->getName());
        $this->driver->setBackgroundJob(true);
        $this->timer = time() + microtime();
    }

    /**
     * @param ConsoleTerminateEvent $event
     */
    public function onConsoleTerminate(ConsoleTerminateEvent $event)
    {
        $elapsed = (time() + microtime()) - $this->timer;
        $this->driver->addParameter('elapsed', $elapsed);
    }

    public static function getSubscribedEvents()
    {
        return array(
            ConsoleEvents::COMMAND   => 'onConsoleCommand',
            ConsoleEvents::TERMINATE => 'onConsoleTerminate'
        );
    }
}
