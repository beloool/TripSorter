<?php

namespace Src\Services\Transportation;

use Src\Helper\Config;

/**
 * Class Plane
 *
 * @package Src\Services\Transportation
 */
class Plane extends AbstractTransportation
{
    const TRANSPORTATION_TYPE = 'plane';

    /**
     * get all information from current Transportation
     *
     * @return string
     * @throws \Exception
     */
    public function getInfo()
    {
        $string = Config::get('trip_sorter')['text_messages'][self::TRANSPORTATION_TYPE];
        $string = sprintf(
            $string,
            $this->departureLocation,
            $this->transportNumber,
            $this->arrivalLocation,
            $this->gate,
            $this->seat
        );

        //ser default information if baggage information not exist
        $baggageCounterMessage = Config::get('trip_sorter')['text_messages']['without_baggage_counter'];
        if (!empty($this->baggageCounter)) {
            $baggageCounterMessage = Config::get('trip_sorter')['text_messages']['with_baggage_counter'];
            $baggageCounterMessage = sprintf($baggageCounterMessage, $this->baggageCounter);
        }


        return $string . "\n" . $baggageCounterMessage;
    }
}
