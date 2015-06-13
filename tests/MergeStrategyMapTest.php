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

        $result = $merge->merge(['name' => 'one'], ['name' => 'another']);

        $this->assertEquals(['name' => 'one', 'another' => ['name' => 'another']], $result);
    }
}
