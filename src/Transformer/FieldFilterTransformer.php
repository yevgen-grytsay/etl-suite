<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Transformer;

/**
 * Unsets fields except specified.
 *
 * Class FieldFilterTransformer
 * @package YevgenGrytsay\EtlSuite\Transformer
 */
class FieldFilterTransformer implements TransformerInterface
{
    /**
     * @var array
     */
    protected $passMask = array();

    /**
     * @param $keys
     */
    public function __construct($keys)
    {
        $maskValues = array_fill(0, count($keys), null);
        $this->passMask = array_combine($keys, $maskValues);
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function transform($data)
    {
        return array_intersect_key($data, $this->passMask);
    }
}