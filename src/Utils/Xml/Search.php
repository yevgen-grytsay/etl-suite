<?php
/**
 * @author: Yevgen Grytsay hrytsai@mti.ua
 * @date  : 25.01.16
 */

namespace YevgenGrytsay\EtlSuite\Utils\Xml;


interface Search
{
    /**
     * @param string $xml
     *
     * @return \DOMNode[]
     */
    public function search($xml);
}