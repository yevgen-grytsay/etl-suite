<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Transformer;

/**
 * Добавляет к ассоциативному массиву поле с константой.
 *
 * Class ConstantTransformer
 * @package YevgenGrytsay\EtlSuite\Transformer
 */
class ConstantTransformer implements TransformerInterface
{
    /**
     * @var
     */
    protected $field;

    /**
     * @var
     */
    protected $value;

    /**
     * @param $field
     * @param $value
     */
    public function __construct($field, $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function transform($data)
    {
        $data[$this->field] = $this->value;

        return $data;
    }
}