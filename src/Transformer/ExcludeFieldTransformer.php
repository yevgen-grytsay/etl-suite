<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Transformer;

/**
 * Class ExcludeFieldTransformer
 * @package YevgenGrytsay\EtlSuite\Transformer
 */
class ExcludeFieldTransformer implements TransformerInterface
{
    /**
     * @var array
     */
    protected $excludeMask = [];

    /**
     * @param $keys
     */
    public function __construct($keys)
    {
        $maskValues = array_fill(0, count($keys), null);
        $this->excludeMask = array_combine($keys, $maskValues);
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function transform($data)
    {
        return array_diff_key($data, $this->excludeMask);
    }
}