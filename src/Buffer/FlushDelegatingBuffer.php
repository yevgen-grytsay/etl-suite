<?php
/**
 * Created by PhpStorm.
 * User: yevgen
 * Date: 26.05.15
 * Time: 16:57
 */

namespace YevgenGrytsay\EtlSuite\Buffer;

/**
 * Буфер, делегирующий очистку (flush), объекту FlushDelegateInterface.
 *
 * Class FlushDelegatingBuffer
 * @package YevgenGrytsay\EtlSuite\Buffer
 */
class FlushDelegatingBuffer extends AbstractBuffer
{
    /**
     * @var \YevgenGrytsay\EtlSuite\Buffer\FlushDelegateInterface
     */
    protected $delegate;

    /**
     * @param \YevgenGrytsay\EtlSuite\Buffer\FlushDelegateInterface $flushDelegate
     */
    public function __construct(FlushDelegateInterface $flushDelegate)
    {
        $this->delegate = $flushDelegate;
    }

    /**
     * {{@inheritdoc}}
     */
    public function flush()
    {
        $this->delegate->push(array_splice($this->elements, 0));
    }
}