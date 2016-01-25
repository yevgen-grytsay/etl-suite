<?php
/**
 * @author: Yevgen Grytsay hrytsai@mti.ua
 * @date  : 25.01.16
 */
use YevgenGrytsay\EtlSuite\Extraction\XmlExtractor;
use YevgenGrytsay\EtlSuite\Iterator\ExtractionIterator;
use YevgenGrytsay\EtlSuite\Utils\Xml\ConstantSearch;
use YevgenGrytsay\EtlSuite\Utils\Xml\TextNodeFilter;
use Zend\Stdlib\Hydrator\NamingStrategy\ArrayMapNamingStrategy;

require_once __DIR__.'/../../vendor/autoload.php';

$xml = file_get_contents('products.xml');

$strategy = new ArrayMapNamingStrategy(array(
    'vendor' => 'brand'
));
$extractor = new XmlExtractor();
$extractor->setNamingStrategy($strategy);
$extractor->addFilter('text_node_filter', new TextNodeFilter());

$search = new ConstantSearch('//*/product');
$list = $search->search($xml);
$iterator = new ExtractionIterator(new ArrayIterator($list), $extractor);

foreach ($iterator as $item) {
    var_dump($item);
}