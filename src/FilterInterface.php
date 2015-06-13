<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite;

/**
 * Interface FilterInterface
 * @package YevgenGrytsay\EtlSuite
 */
interface FilterInterface
{
    /**
     * @param $row
     *
     * @return mixed
     */
    public function filter($row);

    /**
     * @return mixed
     */
    public function getReason();
}