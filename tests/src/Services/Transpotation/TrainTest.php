<?php

use PHPUnit\Framework\TestCase;
use Src\Services\Transportation\Train;

class TrainTest extends TestCase
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
     * @var string
     */
    private $transportNumber = 'test transportNumber';

    /**
     * @var string
     */
    private $seat = 'test seat';

    /**
     * phpunit test setup
     */
    public function setUp()
    {
        $train = new stdClass();
        $train->departureLocation = $this->departureLocation;
        $train->arrivalLocation = $this->arrivalLocation;
        $train->transportNumber = $this->transportNumber;
        $train->seat = $this->seat;

        $this->config = \Mockery::mock('\Src\Helper\Config');

        $this->tested = new Train($train);
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
            ->andReturn('Take train %s from %s to %s. Sit in seat %s.');
        $expected = sprintf(
            'Take train %s from %s to %s. Sit in seat %s.',
            $this->transportNumber,
            $this->departureLocation,
            $this->arrivalLocation,
            $this->seat
        );

        // when
        $actual = $this->tested->getInfo();

        // then
        $this->assertEquals($expected, $actual);
    }
    
}
