<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Buffer;

/**
 * Abstract buffer based on the php array.
 *
 * Class AbstractBuffer
 * @package YevgenGrytsay\EtlSuite\Buffer
 */
abstract class AbstractBuffer implements BufferInterface
{
    /**
     * @var array
     */
    protected $elements = array();

    /**
     * @var
     */
    protected $flushInterval;

    /**
     * {{@inheritdoc}}
     */
    public function push($object)
    {
        $this->elements[] = $object;

        if ($this->flushInterval !== null && $this->count() >= $this->flushInterval) {
            $this->flush();
        }
    }

    abstract public function flush();

    /**
     * {{@inheritdoc}}
     */
    public function count()
    {
        return count($this->elements);
    }

    /**
     * @return mixed
     */
    public function getFlushInterval()
    {
        return $this->flushInterval;
    }

    /**
     * @param mixed $flushInterval
     */
    public function setFlushInterval($flushInterval)
    {
        $this->flushInterval = $flushInterval;
    }
}