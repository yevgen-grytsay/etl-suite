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
        $result = $merge->merge(['name' => 'one'], ['name' => 'another']);

        $this->assertEquals(['name' => 'another'], $result);
    }
}
