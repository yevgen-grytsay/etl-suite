<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Transformer;

/**
 * A transformer consisting of multiple transformers.
 *
 * Class CompositeTransformer
 * @package YevgenGrytsay\EtlSuite\Transformer
 */
class CompositeTransformer implements TransformerInterface
{
    /**
     * @var \YevgenGrytsay\EtlSuite\Transformer\TransformerInterface[]
     */
    protected $transformerChain = [];

    /**
     * @param $name
     * @param \YevgenGrytsay\EtlSuite\Transformer\TransformerInterface $transformer
     *
     * @throws \Exception
     */
    public function addTransformer($name, TransformerInterface $transformer)
    {
        if (array_key_exists($name, $this->transformerChain)) {
            throw new \Exception("Преобразователь с именем '{$name}' уже существует.");
        }
        $this->transformerChain[$name] = $transformer;
    }

    /**
     * @param $name
     */
    public function removeTransformer($name)
    {
        if (array_key_exists($name, $this->transformerChain)) {
            unset($this->transformerChain[$name]);
        }
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function transform($data)
    {
        $carry = $data;
        foreach ($this->transformerChain as $transformer) {
            $carry = $transformer->transform($carry);
        }

        return $carry;
    }
}