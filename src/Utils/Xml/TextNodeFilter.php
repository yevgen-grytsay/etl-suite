<?php
/**
 * @author: Yevgen Grytsay hrytsai@mti.ua
 * @date  : 25.01.16
 */

namespace YevgenGrytsay\EtlSuite\Utils\Xml;


use Zend\Stdlib\Hydrator\Filter\FilterInterface;

class TextNodeFilter implements FilterInterface
{
    /**
     * Should return true, if the given filter
     * does not match
     *
     * @param string $property The name of the property
     *
     * @return bool
     */
    public function filter($property)
    {
        return strpos($property, '#') !== 0;
    }
}