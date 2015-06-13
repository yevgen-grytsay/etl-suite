<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Iterator;

use YevgenGrytsay\EtlSuite\Transformer\TransformerInterface;
use League\Csv\Reader;

/**
 * Class CsvIterator
 * @package YevgenGrytsay\EtlSuite\Iterator
 */
class CsvIterator implements \Iterator
{
    /**
     * @var \Iterator
     */
    protected $reader;

    /**
     * @var TransformerInterface
     */
    protected $transformer;

    /**
     * @param \League\Csv\Reader $reader
     * @param \YevgenGrytsay\EtlSuite\Transformer\TransformerInterface $transformer
     */
    public function __construct(Reader $reader, TransformerInterface $transformer)
    {
        $this->reader = $reader->getIterator();
        $this->transformer = $transformer;
    }


    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        $line = $this->reader->current();
        $data = $this->transformer->transform($line);

        return $data;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->reader->next();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        $this->reader->key();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return $this->reader->valid();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->reader->rewind();
    }
}