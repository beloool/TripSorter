<?php

namespace Src\Services\Transportation;
use Src\Helper\Config;

/**
 * Class Bus
 *
 * @package Src\Services\Transportation
 */
class Bus extends AbstractTransportation
{
    const TRANSPORTATION_TYPE= 'bus';


    /**
     * get all information from current Transportation
     *
     * @return string
     * @throws \Exception
     */
    public function getInfo()
    {
        $string = Config::get('trip_sorter')['text_messages'][self::TRANSPORTATION_TYPE];
        return sprintf($string, $this->departureLocation, $this->arrivalLocation);
    }
}
