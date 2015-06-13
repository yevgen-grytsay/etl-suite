<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Merge;

/**
 * Объединение данных путем слияния. Значения второго массива
 * переписывают значения первого в случае совпадения названий полей.
 *
 * Class MergeStrategyMerge
 * @package YevgenGrytsay\EtlSuite\Merge
 */
class MergeStrategyMerge implements MergeStrategyInterface
{
    /**
     * {{@inheritdoc}}
     */
    public function merge($one, $another)
    {
        return array_merge($one, $another);
    }
}