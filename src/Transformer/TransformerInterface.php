<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Transformer;

/**
 * Performs data transformation.
 *
 * Interface TransformerInterface
 * @package app\utils\ctb\Transformer
 */
interface TransformerInterface
{
    /**
     * @param $data
     *
     * @return mixed
     */
    public function transform($data);
}