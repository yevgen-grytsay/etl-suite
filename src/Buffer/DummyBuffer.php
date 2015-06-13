<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Buffer;

/**
 * Does nothing. Black hole.
 *
 * Class DummyBuffer
 * @package YevgenGrytsay\EtlSuite\Buffer
 */
class DummyBuffer implements BufferInterface
{
    /**
     * Does not store the object anywhere.
     *
     * {{@inheritdoc}}
     */
    public function push($object)
    {
        // Do nothing
    }

    /**
     * {{@inheritdoc}}
     */
    public function flush()
    {
        // Do nothing
    }

    /**
     * Always returns zero.
     *
     * {{@inheritdoc}}
     * @return int Zero.
     */
    public function count()
    {
        return 0;
    }
}