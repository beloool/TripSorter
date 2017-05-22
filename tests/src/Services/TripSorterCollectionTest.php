<?php

use \PHPUnit\Framework\TestCase;
use \Src\Services\TripSorterCollection;

/**
 * Class TripSorter
 *
 * @package Src\Services
 */
class TripSorterCollectionTest extends TestCase
{
    /**
     * @var \Src\Services\TripSorterCollection
     */
    private $tested;

    /**
     * @var
     */
    private $elements;

    /**
     * phpunit test setup
     */
    public function setUp()
    {
        parent::setUp();
        $json = new \Src\Services\Parser\JsonParser();
        $this->elements = $json->getJsonFromFile(DOCUMENT_ROOT . '/data/boarding-card.json');
        $this->tested = new TripSorterCollection($this->elements);
    }

    /**
     * call:
     * phpunit --filter testSortMethodIfElementEmpty
     */
    public function testSortMethodIfElementEmpty()
    {
        // given

        // when
        $actual = new TripSorterCollection([]);
        $actual = $actual->sort();

        // then
        $this->assertEquals([], $actual);
    }

    /**
     * call:
     * phpunit --filter testSortMethod
     */
    public function testSortMethod()
    {
        // given
        $expectedDepartureLocation = 'Madrid';
        $expectedArrivalLocation = 'New York JFK';

        // when
        $actual = $this->tested->sort();

        // then
        $this->assertEquals($actual[0]->departureLocation, $expectedDepartureLocation);
        $this->assertEquals($actual[4]->arrivalLocation, $expectedArrivalLocation);
    }
}
