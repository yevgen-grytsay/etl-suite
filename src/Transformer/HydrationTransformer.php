<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Transformer;

use Zend\Stdlib\Hydrator\HydrationInterface;

/**
 * Выполняет преобразование входных данных к объекту с применением гидраторов.
 *
 * Class HydrationTransformer
 * @package app\utils\ctb\Transformer
 */
class HydrationTransformer implements TransformerInterface
{
    /**
     * @var \Zend\Stdlib\Hydrator\HydrationInterface
     */
    protected $hydrator;

    /**
     * @var \Closure
     */
    protected $fabricClosure;

    /**
     * @param \Zend\Stdlib\Hydrator\HydrationInterface $hydrator
     * @param $fabricClosure
     */
    public function __construct(HydrationInterface $hydrator, \Closure $fabricClosure)
    {
        $this->hydrator = $hydrator;
        $this->fabricClosure = $fabricClosure;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function transform($data)
    {
        $object = call_user_func($this->fabricClosure);

        return $this->hydrator->hydrate($data, $object);
    }
}