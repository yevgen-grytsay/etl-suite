<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Transformer;

use YevgenGrytsay\EtlSuite\Lookup\LookupInterface;
use YevgenGrytsay\EtlSuite\Merge\MergeStrategyInterface;

/**
 * Class LookupTransformer
 * @package YevgenGrytsay\EtlSuite\Transformer
 */
class LookupTransformer implements TransformerInterface
{
    /**
     * @var LookupInterface
     */
    protected $lookup;

    /**
     * @var \YevgenGrytsay\EtlSuite\Merge\MergeStrategyInterface
     */
    protected $merge;

    /**
     * @param \YevgenGrytsay\EtlSuite\Lookup\LookupInterface $lookup
     * @param \YevgenGrytsay\EtlSuite\Merge\MergeStrategyInterface $merge
     */
    public function __construct(LookupInterface $lookup, MergeStrategyInterface $merge)
    {
        $this->lookup = $lookup;
        $this->merge = $merge;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function transform($data)
    {
        $result = $this->lookup->findFor($data);

        return $this->merge->merge($data, $result);
    }
}