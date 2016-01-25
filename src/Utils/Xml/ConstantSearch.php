<?php
/**
 * @author: Yevgen Grytsay hrytsai@mti.ua
 * @date  : 25.01.16
 */

namespace YevgenGrytsay\EtlSuite\Utils\Xml;


class ConstantSearch implements Search
{
    private $xpath;

    /**
     * XmlDomSearch constructor.
     *
     * @param $xpath
     */
    public function __construct($xpath)
    {
        $this->xpath = $xpath;
    }

    /**
     * @param string $xml
     *
     * @return \DOMNode[]
     */
    public function search($xml)
    {
        $factory = new AccessorFactory();
        $nodeList = $factory->createList($xml, $this->xpath);

        return $nodeList;
    }
}