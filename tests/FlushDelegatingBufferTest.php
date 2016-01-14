<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\tests;

use YevgenGrytsay\EtlSuite\Buffer\FlushDelegateInterface;
use YevgenGrytsay\EtlSuite\Buffer\FlushDelegatingBuffer;

/**
 * Class FlushDelegatingBufferTest
 * @package YevgenGrytsay\EtlSuite\tests
 */
class FlushDelegatingBufferTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldCallPushMethodOfDelegate()
    {
        $delegate = $this
            ->getMockBuilder('YevgenGrytsay\EtlSuite\Buffer\FlushDelegateInterface')
            ->getMock();

        $delegate
            ->expects($this->once())
            ->method('push');

        $buffer = new FlushDelegatingBuffer($delegate);
        $buffer->flush();
    }

    public function testShouldEmptyAfterFlush()
    {
        $delegate = $this
            ->getMockBuilder('YevgenGrytsay\EtlSuite\Buffer\FlushDelegateInterface')
            ->getMock();

        $buffer = new FlushDelegatingBuffer($delegate);
        $buffer->push('object');
        $this->assertEquals(1, $buffer->count());

        $buffer->flush();
        $this->assertEquals(0, $buffer->count());
    }

    public function testShouldAutoFlushWhenLimitReached()
    {
        $delegate = $this
            ->getMockBuilder('YevgenGrytsay\EtlSuite\Buffer\FlushDelegateInterface')
            ->getMock();

        $buffer = new FlushDelegatingBuffer($delegate);
        $buffer->setFlushInterval(1);

        $this->assertEquals(0, $buffer->count());
        $buffer->push('object');
        $this->assertEquals(0, $buffer->count());
    }
}
