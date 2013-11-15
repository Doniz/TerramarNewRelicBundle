<?php

namespace Terramar\Bundle\NewRelicBundle\Driver;

/**
 * Default driver
 */
class DefaultDriver implements DriverInterface
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
        \newrelic_custom_metric($name, $value);
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
        \newrelic_add_custom_parameter($key, $value);
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
        \newrelic_name_transaction($name);
    }

    /**
     * Immediately ends the current transaction
     *
     * Useful for long-running requests, such as file downloads, that should not be considered as taking so long.
     *
     * @return void
     */
    public function endTransaction()
    {
        \newrelic_end_of_transaction();
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
        \newrelic_ignore_transaction();
    }
}
