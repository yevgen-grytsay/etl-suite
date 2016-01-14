<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\tests;

use YevgenGrytsay\EtlSuite\Transformer\FieldFilterTransformer;

/**
 * Class FieldFilterTransformerTest
 * @package YevgenGrytsay\EtlSuite\tests
 */
class FieldFilterTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldNotPassField()
    {
        $transformer = new FieldFilterTransformer(array('pass_field'));
        $result = $transformer->transform(array('not_pass_field' => 'some value'));

        $this->assertEmpty($result);
    }

    public function testShouldPassField()
    {
        $transformer = new FieldFilterTransformer(array('pass_field'));
        $result = $transformer->transform(array('pass_field' => 'some value'));

        $this->assertEquals(array('pass_field' => 'some value'), $result);
    }
}
