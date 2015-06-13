<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Lookup;

/**
 * Interface LookupInterface
 * @package YevgenGrytsay\EtlSuite\Lookup
 */
interface LookupInterface
{
    /**
     * @param $row
     *
     * @return mixed
     */
    public function findFor($row);
}