<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\tests;

use YevgenGrytsay\EtlSuite\Merge\MergeStrategyMerge;

/**
 * Class MergeStrategyMergeTest
 * @package YevgenGrytsay\EtlSuite\tests
 */
class MergeStrategyMergeTest extends \PHPUnit_Framework_TestCase
{
    public function testMerge()
    {
        $merge = new MergeStrategyMerge();
        $result = $merge->merge(array('name' => 'one'), array('name' => 'another'));

        $this->assertEquals(array('name' => 'another'), $result);
    }
}
