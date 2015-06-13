<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite;

/**
 * Class ValueMapper
 * @package YevgenGrytsay\EtlSuite
 */
class ValueMapper
{
    /**
     * @var array
     */
    protected $valueMap = [];

    /**
     * @var
     */
    protected $defaultValue;

    /**
     * @var bool
     */
    protected $hasDefaultValue = false;

    /**
     * @param array $valueMap
     */
    public function __construct(array $valueMap)
    {
        $this->valueMap = $valueMap;
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function mapValue($value)
    {
        $result = $value;
        if (array_key_exists($value, $this->valueMap)) {
            $result = $this->valueMap[$value];
        } else if ($this->hasDefaultValue) {
            $result = $this->defaultValue;
        }

        return $result;
    }

    /**
     * @param mixed $defaultValue
     */
    public function setDefaultValue($defaultValue)
    {
        $this->hasDefaultValue = true;
        $this->defaultValue = $defaultValue;
    }
}