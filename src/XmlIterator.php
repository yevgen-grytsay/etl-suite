<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite;

use Symfony\Component\DomCrawler\Crawler;
use Zend\Stdlib\Extractor\ExtractionInterface;

/**
 * Class XmlIterator
 * @package YevgenGrytsay\EtlSuite
 */
class XmlIterator implements \Iterator
{
    /**
     * @var \Symfony\Component\DomCrawler\Crawler
     */
    protected $crawler;

    /**
     * @var \Zend\Stdlib\Extractor\ExtractionInterface
     */
    protected $extractor;

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $xml
     * @param \Zend\Stdlib\Extractor\ExtractionInterface $extractor
     * @param $xpath
     */
    public function __construct(Crawler $xml, ExtractionInterface $extractor, $xpath)
    {
        $this->crawler = $xml->filterXPath($xpath);
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
        $node = $this->crawler->current();
        $data = $this->extractor->extract($node);

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
        $this->crawler->next();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->crawler->key();
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
        return $this->crawler->valid();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->crawler->rewind();
    }
}