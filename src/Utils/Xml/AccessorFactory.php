<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\Utils\Xml;

class AccessorFactory
{
    /**
     * @var string
     */
    private $xmlVersion = '1.0';
    /**
     * @var string
     */
    private $xmlEncoding = 'utf-8';
    /**
     * @var int|null
     */
    private $xmlLoadOptions;

    /**
     * @param \DOMDocument  $xml
     * @param               $xpath
     *
     * @return \Iterator
     */
    public function createIterator($xml, $xpath)
    {
        $nodeList = $this->createList($xml, $xpath);

        return new \ArrayIterator($nodeList);
    }

    /**
     * @param \DOMDocument $xml
     * @param              $xpath
     *
     * @return \DOMNode[]
     */
    public function createList($xml, $xpath)
    {
        $query = new \DOMXPath($this->createDocument($xml));
        $nodes = $query->query($xpath);
        $nodeList = iterator_to_array($nodes);

        return $nodeList;
    }

    /**
     * @param $xml
     *
     * @return \DOMDocument
     */
    private function createDocument($xml)
    {
        $doc = new \DOMDocument($this->xmlVersion, $this->xmlEncoding);
        $doc->loadXML($xml, $this->xmlLoadOptions);

        return $doc;
    }
}