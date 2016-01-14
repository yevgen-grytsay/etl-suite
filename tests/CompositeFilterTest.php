<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\tests;

use YevgenGrytsay\EtlSuite\Filter\CompositeFilter;
use YevgenGrytsay\EtlSuite\FilterInterface;

/**
 * Class CompositeFilterTest
 * @package YevgenGrytsay\EtlSuite\tests
 */
class CompositeFilterTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldCallFilter()
    {
        $child = $this->getMock('YevgenGrytsay\EtlSuite\FilterInterface');
        $child
            ->expects($this->once())
            ->method('filter');

        $filter = new CompositeFilter();
        $filter->addFilter('test', $child);
        $filter->filter(array());
    }

    public function testShouldPassIfChildPass()
    {
        $filterResult = false;
        $child = $this->getMock('YevgenGrytsay\EtlSuite\FilterInterface');
        $child
            ->expects($this->once())
            ->method('filter')
            ->willReturn($filterResult);

        $filter = new CompositeFilter();
        $filter->addFilter('test', $child);
        $result = $filter->filter(array());

        $this->assertEquals($filterResult, $result);
    }

    public function testShouldNotPassIfChildNotPass()
    {
        $filterResult = true;
        $child = $this->getMock('YevgenGrytsay\EtlSuite\FilterInterface');
        $child
            ->expects($this->once())
            ->method('filter')
            ->willReturn($filterResult);

        $filter = new CompositeFilter();
        $filter->addFilter('test', $child);
        $result = $filter->filter(array());

        $this->assertEquals($filterResult, $result);
    }

    public function testShouldNotPassIfAtLeastOneChildNotPass()
    {
        $child = $this->getMock('YevgenGrytsay\EtlSuite\FilterInterface');
        $child
            ->expects($this->once())
            ->method('filter')
            ->willReturn(false);

        $child_two = $this->getMock('YevgenGrytsay\EtlSuite\FilterInterface');
        $child_two
            ->expects($this->once())
            ->method('filter')
            ->willReturn(true);

        $filter = new CompositeFilter();
        $filter->addFilter('test', $child);
        $filter->addFilter('test_two', $child_two);
        $result = $filter->filter(array());

        $this->assertEquals(true, $result);
    }

    public function testShouldBreakAtFirstPositiveResult()
    {
        $child = $this->getMock('YevgenGrytsay\EtlSuite\FilterInterface');
        $child
            ->expects($this->once())
            ->method('filter')
            ->willReturn(true);

        $child_two = $this->getMock('YevgenGrytsay\EtlSuite\FilterInterface');
        $child_two
            ->expects($this->never())
            ->method('filter');

        $filter = new CompositeFilter();
        $filter->addFilter('test', $child);
        $filter->addFilter('test_two', $child_two);
        $result = $filter->filter(array());

        $this->assertEquals(true, $result);
    }
}
