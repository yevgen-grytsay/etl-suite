<?php
/**
 * In this example we read data from CSV file line by line using the Excel iterator.
 * Then we replace numeric keys by meaningful string keys using the array transformer
 * and corresponding naming strategy.
 * Then we dump result array to stdout.
 *
 * @author: yevgen
 */
use YevgenGrytsay\EtlSuite\Iterator\ExcelIterator;
use YevgenGrytsay\EtlSuite\Transformer\ArrayTransformer;
use Zend\Stdlib\Hydrator\NamingStrategy\ArrayMapNamingStrategy;

require_once __DIR__.'/../../vendor/autoload.php';
require_once 'DumpBuffer.php';

/**
 * @var \PHPExcel_Reader_CSV $reader
 */
$file = 'products.csv';
$reader = \PHPExcel_IOFactory::createReaderForFile($file);
$reader->setDelimiter(',')->setEnclosure('"');
$excel = $reader->load($file);
$sheet = $excel->getActiveSheet();

$iterator = new ExcelIterator($sheet);

/**
 * Setup buffer
 */
$buffer = new DumpBuffer();
$buffer->setFlushInterval(1000);

/**
 * Setup transformer
 */
$propertyMap = [
    0 => 'name',
    1 => 'quantity',
    2 => 'price'
];
$namingStrategy = new ArrayMapNamingStrategy(array_flip($propertyMap));
$transformer = new ArrayTransformer($namingStrategy);

/**
 * Perform ETL
 */
foreach ($iterator as $element) {
    $buffer->push($transformer->transform($element));
}

$buffer->flush();