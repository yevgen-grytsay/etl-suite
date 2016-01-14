<?php
/**
 * @author: yevgen
 */

namespace YevgenGrytsay\EtlSuite\tests;

use YevgenGrytsay\EtlSuite\Lookup\FinderInterface;
use YevgenGrytsay\EtlSuite\Lookup\Lookup;

/**
 * Class LookupTest
 * @package YevgenGrytsay\EtlSuite\tests
 */
class LookupTest extends \PHPUnit_Framework_TestCase
{
    public function testExtraction()
    {
        $finder = $this->getMockBuilder('YevgenGrytsay\EtlSuite\Lookup\FinderInterface')->getMock();
        $finder
            ->expects($this->once())
            ->method('findBy')
            ->willReturn(array('name' => 'one'));
        $lookup = new Lookup(array('first_name' => 'name'), array('name'), $finder);

        $result = $lookup->findFor(array('first_name' => 'one'));

        $this->assertEquals(array('name' => 'one'), $result);
    }

    public function testMapExtraction()
    {
        $finder = $this->getMockBuilder('YevgenGrytsay\EtlSuite\Lookup\FinderInterface')->getMock();
        $finder
            ->expects($this->once())
            ->method('findBy')
            ->willReturn(array('name' => 'one'));
        $lookup = new Lookup(array('first_name' => 'name'), array('extracted_name' => 'name'), $finder);

        $result = $lookup->findFor(array('first_name' => 'one'));

        $this->assertEquals(array('extracted_name' => 'one'), $result);
    }

    public function testShouldPassCriteria()
    {
        $finder = $this->getMockBuilder('YevgenGrytsay\EtlSuite\Lookup\FinderInterface')->getMock();
        $finder
            ->expects($this->once())
            ->method('findBy')
            ->with(array('name' => 'one'));
        $lookup = new Lookup(array('first_name' => 'name'), array('extracted_name' => 'name'), $finder);

        $lookup->findFor(array('first_name' => 'one'));
    }

    public function testShouldPassOnlyLookupFieldsAsCriteria()
    {
        $finder = $this->getMockBuilder('YevgenGrytsay\EtlSuite\Lookup\FinderInterface')->getMock();
        $finder
            ->expects($this->once())
            ->method('findBy')
            ->with(array('name' => 'one'));
        $lookup = new Lookup(array('first_name' => 'name'), array('extracted_name' => 'name'), $finder);

        $lookup->findFor(array('first_name' => 'one', 'location' => 'another'));
    }

    public function testShouldExtractOnlyExtractionFields()
    {
        $finder = $this->getMockBuilder('YevgenGrytsay\EtlSuite\Lookup\FinderInterface')->getMock();
        $finder
            ->expects($this->once())
            ->method('findBy')
            ->willReturn(array('name' => 'one', 'location' => 'another'));
        $lookup = new Lookup(array('first_name' => 'name'), array('extracted_name' => 'name'), $finder);

        $result = $lookup->findFor(array('first_name' => 'one'));

        $this->assertEquals(array('extracted_name' => 'one'), $result);
    }
}
