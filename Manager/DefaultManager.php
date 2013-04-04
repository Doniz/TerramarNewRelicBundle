<?php

namespace Terramar\Bundle\NewRelicBundle\Manager;

use Terramar\Bundle\NewRelicBundle\Driver\DriverInterface;

/**
 * Default NewRelic Manager
 */
class DefaultManager implements ManagerInterface
{
    /**
     * @var DriverInterface
     */
    private $driver;

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
     * Add a metric to the transaction
     *
     * @param string $name
     * @param string $value
     *
     * @return void
     */
    public function addMetric($name, $value)
    {
        $this->driver->addMetric($name, $value);
    }

    /**
     * Add a parameter to the current transaction
     *
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function addParameter($key, $value)
    {
        $this->driver->addParameter($key, $value);
    }

    /**
     * Sets the current transaction's name
     *
     * @param string $name
     *
     * @return void
     */
    public function setTransactionName($name)
    {
        $this->driver->setTransactionName($name);
    }

    /**
     * Immediately ends the current transaction
     *
     * Useful for long-running requests, such as file downloads, and should not be considered as taking so long.
     *
     * @return void
     */
    public function endTransaction()
    {
        $this->driver->endTransaction();
    }
}
