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
        $child = $this->getMock(FilterInterface::class);
        $child
            ->expects($this->once())
            ->method('filter');

        $filter = new CompositeFilter();
        $filter->addFilter('test', $child);
        $filter->filter([]);
    }

    public function testShouldPassIfChildPass()
    {
        $filterResult = false;
        $child = $this->getMock(FilterInterface::class);
        $child
            ->expects($this->once())
            ->method('filter')
            ->willReturn($filterResult);

        $filter = new CompositeFilter();
        $filter->addFilter('test', $child);
        $result = $filter->filter([]);

        $this->assertEquals($filterResult, $result);
    }

    public function testShouldNotPassIfChildNotPass()
    {
        $filterResult = true;
        $child = $this->getMock(FilterInterface::class);
        $child
            ->expects($this->once())
            ->method('filter')
            ->willReturn($filterResult);

        $filter = new CompositeFilter();
        $filter->addFilter('test', $child);
        $result = $filter->filter([]);

        $this->assertEquals($filterResult, $result);
    }

    public function testShouldNotPassIfAtLeastOneChildNotPass()
    {
        $child = $this->getMock(FilterInterface::class);
        $child
            ->expects($this->once())
            ->method('filter')
            ->willReturn(false);

        $child_two = $this->getMock(FilterInterface::class);
        $child_two
            ->expects($this->once())
            ->method('filter')
            ->willReturn(true);

        $filter = new CompositeFilter();
        $filter->addFilter('test', $child);
        $filter->addFilter('test_two', $child_two);
        $result = $filter->filter([]);

        $this->assertEquals(true, $result);
    }

    public function testShouldBreakAtFirstPositiveResult()
    {
        $child = $this->getMock(FilterInterface::class);
        $child
            ->expects($this->once())
            ->method('filter')
            ->willReturn(true);

        $child_two = $this->getMock(FilterInterface::class);
        $child_two
            ->expects($this->never())
            ->method('filter');

        $filter = new CompositeFilter();
        $filter->addFilter('test', $child);
        $filter->addFilter('test_two', $child_two);
        $result = $filter->filter([]);

        $this->assertEquals(true, $result);
    }
}
