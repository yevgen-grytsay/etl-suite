<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\tests;

use YevgenGrytsay\EtlSuite\Transformer\CompositeTransformer;
use YevgenGrytsay\EtlSuite\Transformer\TransformerInterface;

/**
 * Class CompositeTransformerTest
 * @package YevgenGrytsay\EtlSuite\tests
 */
class CompositeTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldCallTransform()
    {
        $transformer = $this->getMock('YevgenGrytsay\EtlSuite\Transformer\TransformerInterface');
        $transformer
            ->expects($this->once())
            ->method('transform');

        $composite = new CompositeTransformer();
        $composite->addTransformer('name', $transformer);
        $composite->transform('');
    }

    public function testShouldPassProperDataToTransformMethod()
    {
        $data = array(3, 4);
        $transformer = $this->getMock('YevgenGrytsay\EtlSuite\Transformer\TransformerInterface');
        $transformer
            ->expects($this->once())
            ->method('transform')
        ->with($data);

        $composite = new CompositeTransformer();
        $composite->addTransformer('name', $transformer);
        $composite->transform($data);
    }

    public function testShouldPassToSecondTransformerResultOfFirst()
    {
        $value = 'some value';
        $transformer_one = $this->getMock('YevgenGrytsay\EtlSuite\Transformer\TransformerInterface');
        $transformer_one
            ->expects($this->once())
            ->method('transform')
            ->willReturn($value);

        $transformer_two = $this->getMock('YevgenGrytsay\EtlSuite\Transformer\TransformerInterface');
        $transformer_two
            ->expects($this->once())
            ->method('transform')
            ->with($value);

        $composite = new CompositeTransformer();
        $composite->addTransformer('name', $transformer_one);
        $composite->addTransformer('name2', $transformer_two);

        $composite->transform(array());
    }
}
