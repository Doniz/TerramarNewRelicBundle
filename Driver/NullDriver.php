<?php

namespace Terramar\Bundle\NewRelicBundle\Driver;

/**
 * Disabled driver
 */
class NullDriver implements DriverInterface
{
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
        // noop
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
        // noop
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
        // noop
    }

    /**
     * Immediately ends the current transaction
     *
     * Useful for long-running requests, such as file downloads, that should not be considered
     * as taking so long.
     *
     * @return void
     */
    public function endTransaction()
    {
        // noop
    }

    /**
     * Do not generate metrics for this transaction.
     *
     * This is useful when you have transactions that are particularly slow for known reasons
     * and you do not want them always being reported as the transaction trace or skewing your
     * site averages.
     *
     * @return void
     */
    public function ignoreTransaction()
    {
        // no op
    }
}
