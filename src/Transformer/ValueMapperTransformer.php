<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Transformer;

use YevgenGrytsay\EtlSuite\ValueMapper;

/**
 * Class ValueMapperTransformer
 * @package YevgenGrytsay\EtlSuite\Transformer
 */
class ValueMapperTransformer implements TransformerInterface
{
    /**
     * @var ValueMapper[]
     */
    protected $valueMapperMap = [];

    /**
     * @param $field
     * @param \YevgenGrytsay\EtlSuite\ValueMapper $mapper
     */
    public function addValueMapper($field, ValueMapper $mapper)
    {
        $this->valueMapperMap[$field] = $mapper;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function transform($data)
    {
        $result = [];
        foreach ($data as $name => $value) {
            $result[$name] = $this->mapValue($name, $value);
        }

        return $result;
    }

    /**
     * @param $name
     * @param $value
     *
     * @return mixed
     */
    protected function mapValue($name, $value)
    {
        if (array_key_exists($name, $this->valueMapperMap)) {
            $mapper = $this->valueMapperMap[$name];
            $value = $mapper->mapValue($value);
        }

        return $value;
    }
}