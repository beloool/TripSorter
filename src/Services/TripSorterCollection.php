<?php

namespace Src\Services;

use Src\Services\Transportation\Bus;
use Src\Services\Transportation\Plane;
use Src\Services\Transportation\Train;

/**
 * Class TripSorter
 * sort all Boardings in the right position
 * and handle all Boarding cards for the right Transportation
 *
 * @package Src\Services
 */
class TripSorterCollection
{

    /**
     * @var array
     */
    private $elements;

    /**
     * @var array
     */
    private $transportation = [];

    /**
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    /**
     * sort the current boarding cards ($this->elements) as array
     * to the right position.
     *
     * @return array
     */
    public function sort(): array
    {
        if (!empty($this->elements)) {
            foreach ($this->elements as $key => $element) {
                //check wich Trip is previous trip oder last trip
                list($previousTrip, $lastTrip) = $this->determineTrip($element);

                //prepare trip elements
                if (!$previousTrip) {
                    array_unshift($this->elements, $this->elements[$key]);
                    unset($this->elements[$key]);
                } elseif ($lastTrip) {
                    array_push($this->elements, $this->elements[$key]);
                    unset($this->elements[$key]);
                }
            }
        }
        return $this->elements;
    }

    /**
     * helper for sorting the boarding cards
     *
     * @param $element
     * @return array
     */
    private function determineTrip($element)
    {
        $previousTrip = false;
        $lastTrip = true;
        foreach ($this->elements as $index => $item) {
            if ($element->departureLocation == $item->arrivalLocation) {
                $previousTrip = true;
            } elseif ($element->arrivalLocation == $item->departureLocation) {
                $lastTrip = false;
            }
        }
        return array($previousTrip, $lastTrip);
    }

    /**
     * search the transportation for the current Boarding card
     *
     * @return array
     * @throws \Exception
     */
    public function prepareTransportation()
    {
        foreach ($this->elements as $index => $element) {
            switch (strtolower($element->transportation)) {
                case Train::TRANSPORTATION_TYPE:
                    $this->transportation[] = new Train($element);
                    break;
                case Bus::TRANSPORTATION_TYPE:
                    $this->transportation[] = new Bus($element);
                    break;
                case Plane::TRANSPORTATION_TYPE:
                    $this->transportation[] = new Plane($element);
                    break;
                default:
                    throw new \Exception('transportation nor supported  : %s', $element->transportation);
            }
        }
        return $this->transportation;
    }
}
