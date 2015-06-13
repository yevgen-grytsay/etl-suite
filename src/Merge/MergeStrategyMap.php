<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Merge;

/**
 * Обыединение данных путем присвоения второго массива определенному
 * полю первого массива.
 *
 * Class MergeStrategyMap
 * @package YevgenGrytsay\EtlSuite\Merge
 */
class MergeStrategyMap implements MergeStrategyInterface
{
    /**
     * @var
     */
    protected $key;

    /**
     * @param $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * {{@inheritdoc}}
     */
    public function merge($one, $another)
    {
        $one[$this->key] = $another;

        return $one;
    }
}