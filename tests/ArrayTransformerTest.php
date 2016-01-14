<?php
namespace YevgenGrytsay\EtlSuite\tests;

use YevgenGrytsay\EtlSuite\Transformer\ArrayTransformer;

/**
 * @author: Yevgen Grytsay hrytsai@mti.ua
 * @date  : 14.01.16
 */
class ArrayTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testTransform()
    {
        $data = array('key' => 'value');
        $strat = $this->getMock('\Zend\Stdlib\Hydrator\NamingStrategy\NamingStrategyInterface');
        $strat->expects($this->once())
            ->method('hydrate')
            ->willReturn('key');

        $transformer = new ArrayTransformer($strat);
        $result = $transformer->transform($data);

        $this->assertEquals(array('key' => 'value'), $result);
    }

    public function testShouldUseHydratedKey()
    {
        $data = array('key' => 'value');
        $strat = $this->getMock('\Zend\Stdlib\Hydrator\NamingStrategy\NamingStrategyInterface');
        $strat->expects($this->once())
            ->method('hydrate')
            ->willReturn('hydrated_key');

        $transformer = new ArrayTransformer($strat);
        $result = $transformer->transform($data);

        $this->assertEquals(array('hydrated_key' => 'value'), $result);
    }
}
