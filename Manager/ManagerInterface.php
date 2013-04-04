<?php

namespace Terramar\Bundle\NewRelicBundle\Manager;

/**
 * Defines the contract any NewRelic Manager must follow
 */
interface ManagerInterface
{
    /**
     * Add a metric to the transaction
     *
     * @param string $name
     * @param string $value
     *
     * @return void
     */
    public function addMetric($name, $value);

    /**
     * Add a parameter to the current transaction
     *
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function addParameter($key, $value);

    /**
     * Sets the current transaction's name
     *
     * @param string $name
     *
     * @return void
     */
    public function setTransactionName($name);

    /**
     * Immediately ends the current transaction
     *
     * Useful for long-running requests, such as file downloads, and should not be considered as taking so long.
     *
     * @return void
     */
    public function endTransaction();
}
