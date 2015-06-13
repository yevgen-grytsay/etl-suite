<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\tests;

use YevgenGrytsay\EtlSuite\ValueMapper;

/**
 * Class ValueMapperTest
 * @package YevgenGrytsay\EtlSuite\tests
 */
class ValueMapperTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldMap()
    {
        $mapper = new ValueMapper(['Y' => 'yes']);
        $value = $mapper->mapValue('Y');

        $this->assertEquals('yes', $value);
    }

    public function testShouldPass()
    {
        $mapper = new ValueMapper(['Y' => 'yes']);
        $value = $mapper->mapValue('N');

        $this->assertEquals('N', $value);
    }

    public function testShouldUseDefaultPass()
    {
        $mapper = new ValueMapper(['Y' => 'yes']);
        $mapper->setDefaultValue('default_value');
        $value = $mapper->mapValue('N');

        $this->assertEquals('default_value', $value);
    }
}
