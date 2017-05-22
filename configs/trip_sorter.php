<?php

return [

    /**
     * path to json file
     */
    'json_file' => DOCUMENT_ROOT . '/data/boarding-card.json',

    /**
     * define all output messages
     */
    'text_messages' => [
        \Src\Services\Transportation\Train::TRANSPORTATION_TYPE => 'Take train %s from %s to %s. Sit in seat %s.',
        \Src\Services\Transportation\Bus::TRANSPORTATION_TYPE => 'Take the airport bus from %s to %s. No seat assignment.',
        \Src\Services\Transportation\Plane::TRANSPORTATION_TYPE => 'From %s, take flight %s to %s. Gate %s, seat %s.',
        'with_baggage_counter' => 'Baggage drop at ticket counter %s.',
        'without_baggage_counter' => 'Baggage will we automatically transferred from your last leg.',
        'final' => 'You have arrived at your final destination.',
    ],
];
