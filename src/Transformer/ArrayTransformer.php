<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Transformer;

use Zend\Stdlib\Hydrator\NamingStrategy\NamingStrategyInterface;

/**
 * Class ArrayTransformer
 * @package YevgenGrytsay\EtlSuite\Transformer
 */
class ArrayTransformer implements TransformerInterface
{
    /**
     * @var \Zend\Stdlib\Hydrator\NamingStrategy\NamingStrategyInterface
     */
    protected $namingStrategy;

    /**
     * @param \Zend\Stdlib\Hydrator\NamingStrategy\NamingStrategyInterface $namingStrategy
     */
    public function __construct(NamingStrategyInterface $namingStrategy)
    {
        $this->namingStrategy = $namingStrategy;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function transform($data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            $hydratedKey = $this->namingStrategy->hydrate($key);
            $result[$hydratedKey] = $value;
        }

        return $result;
    }
}