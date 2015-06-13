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
        $finder = $this->getMockBuilder(FinderInterface::class)->getMock();
        $finder
            ->expects($this->once())
            ->method('findBy')
            ->willReturn(['name' => 'one']);
        $lookup = new Lookup(['first_name' => 'name'], ['name'], $finder);

        $result = $lookup->findFor(['first_name' => 'one']);

        $this->assertEquals(['name' => 'one'], $result);
    }

    public function testMapExtraction()
    {
        $finder = $this->getMockBuilder(FinderInterface::class)->getMock();
        $finder
            ->expects($this->once())
            ->method('findBy')
            ->willReturn(['name' => 'one']);
        $lookup = new Lookup(['first_name' => 'name'], ['extracted_name' => 'name'], $finder);

        $result = $lookup->findFor(['first_name' => 'one']);

        $this->assertEquals(['extracted_name' => 'one'], $result);
    }

    public function testShouldPassCriteria()
    {
        $finder = $this->getMockBuilder(FinderInterface::class)->getMock();
        $finder
            ->expects($this->once())
            ->method('findBy')
            ->with(['name' => 'one']);
        $lookup = new Lookup(['first_name' => 'name'], ['extracted_name' => 'name'], $finder);

        $lookup->findFor(['first_name' => 'one']);
    }

    public function testShouldPassOnlyLookupFieldsAsCriteria()
    {
        $finder = $this->getMockBuilder(FinderInterface::class)->getMock();
        $finder
            ->expects($this->once())
            ->method('findBy')
            ->with(['name' => 'one']);
        $lookup = new Lookup(['first_name' => 'name'], ['extracted_name' => 'name'], $finder);

        $lookup->findFor(['first_name' => 'one', 'location' => 'another']);
    }

    public function testShouldExtractOnlyExtractionFields()
    {
        $finder = $this->getMockBuilder(FinderInterface::class)->getMock();
        $finder
            ->expects($this->once())
            ->method('findBy')
            ->willReturn(['name' => 'one', 'location' => 'another']);
        $lookup = new Lookup(['first_name' => 'name'], ['extracted_name' => 'name'], $finder);

        $result = $lookup->findFor(['first_name' => 'one']);

        $this->assertEquals(['extracted_name' => 'one'], $result);
    }
}
