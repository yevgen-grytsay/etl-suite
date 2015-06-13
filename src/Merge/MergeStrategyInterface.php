<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Merge;

/**
 * The strategy of merging of two arrays.
 *
 * Interface MergeStrategyInterface
 * @package YevgenGrytsay\EtlSuite\Merge
 */
interface MergeStrategyInterface
{
    /**
     * @param $one
     * @param $another
     *
     * @return mixed
     */
    public function merge($one, $another);
}