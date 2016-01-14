<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\tests;

use YevgenGrytsay\EtlSuite\Transformer\ValueMapperTransformer;
use YevgenGrytsay\EtlSuite\ValueMapper;

/**
 * Class ValueMapperTransformerTest
 * @package YevgenGrytsay\EtlSuite\tests
 */
class ValueMapperTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldMapValuePresentInMap()
    {
        $mapper = $this
            ->getMockBuilder('YevgenGrytsay\EtlSuite\ValueMapper')
            ->disableOriginalConstructor()
            ->getMock();
        $mapper
            ->expects($this->once())
            ->method('mapValue');

        $transformer = new ValueMapperTransformer();
        $transformer->addValueMapper('field', $mapper);

        $transformer->transform(array('field' => 'value'));
    }

    public function testShouldPassCorrespondingValueToMapper()
    {
        $value = 'value';
        $mapper = $this
            ->getMockBuilder('YevgenGrytsay\EtlSuite\ValueMapper')
            ->disableOriginalConstructor()
            ->getMock();
        $mapper
            ->expects($this->once())
            ->method('mapValue')
            ->with($value);

        $transformer = new ValueMapperTransformer();
        $transformer->addValueMapper('field', $mapper);

        $transformer->transform(array('field' => $value));
    }

    public function testShouldNotMapValueNotPresentInMap()
    {
        $mapper = $this
            ->getMockBuilder('YevgenGrytsay\EtlSuite\ValueMapper')
            ->disableOriginalConstructor()
            ->getMock();
        $mapper
            ->expects($this->never())
            ->method('mapValue');

        $transformer = new ValueMapperTransformer();
        $transformer->addValueMapper('other_field', $mapper);

        $transformer->transform(array('field' => 'value'));
    }
}
