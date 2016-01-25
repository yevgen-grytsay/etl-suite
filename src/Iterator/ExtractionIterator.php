<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Iterator;

use YevgenGrytsay\EtlSuite\Utils\Xml\IteratorDecorator;
use Zend\Stdlib\Extractor\ExtractionInterface;

class ExtractionIterator extends IteratorDecorator
{
    /**
     * @var \Zend\Stdlib\Extractor\ExtractionInterface
     */
    protected $extractor;

    /**
     * ExtractionIterator constructor.
     *
     * @param \Iterator                                  $iterator
     * @param \Zend\Stdlib\Extractor\ExtractionInterface $extractor
     */
    public function __construct(\Iterator $iterator, ExtractionInterface $extractor)
    {
        parent::__construct($iterator);
        $this->extractor = $extractor;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        $node = parent::current();
        $data = $this->extractor->extract($node);

        return $data;
    }
}