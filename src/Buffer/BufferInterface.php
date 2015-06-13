<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Buffer;

/**
 * Holds objects.
 *
 * Interface BufferInterface
 * @package YevgenGrytsay\EtlSuite\Buffer
 */
interface BufferInterface extends \Countable
{
    /**
     * Appends an element to the buffer.
     *
     * @param $object
     */
    public function push($object);

    /**
     * Flushes the buffer.
     */
    public function flush();
}