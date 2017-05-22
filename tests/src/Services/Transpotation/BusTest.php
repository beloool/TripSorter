<?php

use PHPUnit\Framework\TestCase;
use Src\Services\Transportation\Bus;

class BusTest extends TestCase
{
    /**
     * @var Bus
     */
    private $tested;

    /**
     * @var \Src\Helper\Config
     */
    private $config;

    /**
     * @var string
     */
    private $departureLocation = 'test departureLocation';

    /**
     * @var string
     */
    private $arrivalLocation = 'test arrivalLocation';

    /**
     * phpunit test setup
     */
    public function setUp()
    {
        $bus = new stdClass();
        $bus->departureLocation = $this->departureLocation;
        $bus->arrivalLocation = $this->arrivalLocation;

        $this->config = \Mockery::mock('\Src\Helper\Config');

        $this->tested = new Bus($bus);
    }

    /**
     * call:
     * phpunit --filter testGetInfo
     *
     * test to get the current Transportation information
     */
    public function testGetInfo()
    {
        // given
        $this->config->shouldReceive('get')
            ->with('string')
            ->once()
            ->andReturn('Take the airport bus from %s to %s. No seat assignment.');
        $expected = sprintf('Take the airport bus from %s to %s. No seat assignment.', $this->departureLocation, $this->arrivalLocation);

        // when
        $actual = $this->tested->getInfo();

        // then
        $this->assertEquals($expected, $actual);
    }

}
