<?php

use PHPUnit\Framework\TestCase;
use Src\Services\Transportation\Plane;

class PlaneTest extends TestCase
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
     * @var string
     */
    private $gate = 'test gate';

    /**
     * phpunit test setup
     */
    public function setUp()
    {
        $plane = new stdClass();
        $plane->departureLocation = $this->departureLocation;
        $plane->arrivalLocation = $this->arrivalLocation;
        $plane->transportNumber = $this->transportNumber;
        $plane->seat = $this->seat;
        $plane->gate = $this->gate;

        $this->config = \Mockery::mock('\Src\Helper\Config');

        $this->tested = new Plane($plane);
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
            ->andReturn("From %s, take flight %s to %s. Gate %s, seat %s.\n" . 'Baggage will we automatically transferred from your last leg.');
        $expected = sprintf(
            "From %s, take flight %s to %s. Gate %s, seat %s.\n",
            $this->departureLocation,
            $this->transportNumber,
            $this->arrivalLocation,
            $this->gate,
            $this->seat
        );
        $expected = $expected . 'Baggage will we automatically transferred from your last leg.';

        // when
        $actual = $this->tested->getInfo();

        // then
        $this->assertEquals($expected, $actual);
    }
}
