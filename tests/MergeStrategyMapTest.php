<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\tests;

use YevgenGrytsay\EtlSuite\Merge\MergeStrategyMap;

/**
 * Class MergeStrategyMapTest
 * @package YevgenGrytsay\EtlSuite\tests
 */
class MergeStrategyMapTest extends \PHPUnit_Framework_TestCase
{
    public function testMerge()
    {
        $merge = new MergeStrategyMap('another');

        $result = $merge->merge(array('name' => 'one'), array('name' => 'another'));

        $this->assertEquals(array('name' => 'one', 'another' => array('name' => 'another')), $result);
    }
}
