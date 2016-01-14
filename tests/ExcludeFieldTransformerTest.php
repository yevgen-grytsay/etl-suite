<?php
/**
 * @author: Yevgen Grytsay hrytsai@mti.ua
 * @date  : 14.01.16
 */

namespace YevgenGrytsay\EtlSuite\tests;


use YevgenGrytsay\EtlSuite\Transformer\ExcludeFieldTransformer;

class ExcludeFieldTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testExcludeField()
    {
        $transformer = new ExcludeFieldTransformer(array('key'));
        $result = $transformer->transform(array('key' => 'value'));

        $this->assertEquals(array(), $result);
    }
}
