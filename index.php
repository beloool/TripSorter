<?php
// Define path to source directory
defined('DOCUMENT_ROOT') || define('DOCUMENT_ROOT', __DIR__);
// Composer autoload
require_once __DIR__ . '/vendor/autoload.php';

use Src\Helper\Config;
use Src\Services\Parser\JsonParser;
use Src\Services\TripSorterCollection;

//get Json file
$parser = new JsonParser();
$boardingCards = $parser->getJsonFromFile('data/boarding-card.json');

//handle trips with transportation
$tripSorter = new TripSorterCollection($boardingCards);
$tripSorter->sort();
$trips = $tripSorter->prepareTransportation();


//show transportation Information
if (count($trips) > 0) {
    foreach ($trips as $trip) {
        echo $trip->getInfo();
        echo "\n";
    }
    echo Config::get('trip_sorter')['text_messages']['final'];
    echo "\n";
}
