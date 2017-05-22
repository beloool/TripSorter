<?php

namespace Src\Services\Transportation;

/**
 * Class AbstractTransport
 *
 * @package Src\Services\Transportation
 */
abstract class AbstractTransportation implements TransportationInterface
{

    /**
     * @var string
     */
    protected $departureLocation;

    /**
     * @var string
     */
    protected $transportation;

    /**
     * @var string
     */
    protected $transportNumber;

    /**
     * @var string
     */
    protected $seat;

    /**
     * @var string
     */
    protected $gate;

    /**
     * @var string
     */
    protected $baggageCounter;

    /**
     * @var string
     */
    protected $arrivalLocation;


    /**
     * set automaticly getter an setter methods
     */
    public function __construct(\stdClass $trip)
    {

        foreach ($trip as $key => $value) {
            // Replace underscore(_) by CamelCase to match the attribute
            $property = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));

            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }

        if (property_exists($this, $property)) {
            $this->{$property} = $value;
        }
    }



}