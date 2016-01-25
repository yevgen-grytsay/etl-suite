<?php
/**
 * @author: Yevgen Grytsay hrytsai@mti.ua
 * @date  : 25.01.16
 */

namespace YevgenGrytsay\EtlSuite\Extraction;


use Zend\Stdlib\Exception\BadMethodCallException;
use Zend\Stdlib\Hydrator\AbstractHydrator;

class XmlExtractor extends AbstractHydrator
{
    /**
     * Extract values from an object
     *
     * @param  object $object
     *
     * @return array
     */
    public function extract($object)
    {
        if (!$object instanceof \DOMNode) {
            throw new BadMethodCallException(
                sprintf('%s expects the provided $object to be an instance of Symfony\Component\DomCrawler\Crawler)',
                    __METHOD__)
            );
        }

        $filter = $this->getFilter();

        /**
         * @var \DOMElement $domNode
         */
        $data = array();
        foreach ($object->childNodes as $domNode) {
//            if ($domNode instanceof \DOMText) {
//                continue;
//            }
            $name = $domNode->nodeName;
            $value = $domNode->textContent;
            // Filter keys, removing any we don't want
            if (! $filter->filter($name)) {
                continue;
            }

            // Replace name if extracted differ
            $extracted = $this->extractName($name, $object);

            if ($extracted !== $name) {
                $name = $extracted;
            }

            $data[$name] = $this->extractValue($name, $value, $object);
        }

        return $data;
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array  $data
     * @param  object $object
     *
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        throw new \RuntimeException('Method '. __METHOD__ .' is not yet implemented.');
    }
}