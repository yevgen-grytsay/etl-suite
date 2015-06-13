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
        $transformer = $this->getMock(TransformerInterface::class);
        $transformer
            ->expects($this->once())
            ->method('transform');

        $composite = new CompositeTransformer();
        $composite->addTransformer('name', $transformer);
        $composite->transform('');
    }

    public function testShouldPassProperDataToTransformMethod()
    {
        $data = [3, 4];
        $transformer = $this->getMock(TransformerInterface::class);
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
        $transformer_one = $this->getMock(TransformerInterface::class);
        $transformer_one
            ->expects($this->once())
            ->method('transform')
            ->willReturn($value);

        $transformer_two = $this->getMock(TransformerInterface::class);
        $transformer_two
            ->expects($this->once())
            ->method('transform')
            ->with($value);

        $composite = new CompositeTransformer();
        $composite->addTransformer('name', $transformer_one);
        $composite->addTransformer('name2', $transformer_two);

        $composite->transform([]);
    }
}
