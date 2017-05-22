<?php

namespace Src\Services\Transportation;
use Src\Helper\Config;

/**
 * Class Train
 *
 * @package Src\Services\Transportation
 */
class Train extends AbstractTransportation
{
    const TRANSPORTATION_TYPE= 'train';

    /**
     * get all information from current Transportation
     * @return string
     * @throws \Exception
     */
    public function getInfo()
    {
        $string = Config::get('trip_sorter')['text_messages'][self::TRANSPORTATION_TYPE];
        return sprintf($string, $this->transportNumber, $this->departureLocation, $this->arrivalLocation, $this->seat);
    }
}
