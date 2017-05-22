<?php

use Src\Services\Parser\JsonParser;
use PHPUnit\Framework\TestCase;

/**
 * Class JsonParserTest
 *
 * @package Parser
 */
class JsonParserTest extends TestCase
{
    /**
     * @var JsonParser
     */
    private $tested;

    /**
     * phpunit test setup
     */
    public function setUp()
    {
        parent::setUp();
        $this->tested = new JsonParser;
    }

    /**
     * call:
     * phpunit --filter testToGetJsonFileIfNotExist
     *
     * @expectedException Exception
     * @return void
     */
    public function testToGetJsonFileIfNotExist()
    {
        // when
        $actual = $this->tested->getJsonFromFile('file.json');

        // then
        $this->expectException($actual);
    }



    /**
     * call:
     * phpunit --filter testToGetJsonFileAsArray
     *
     * @return void
     */
    public function testToGetJsonFileAsArray()
    {
        // given
        $expected = 'departureLocation';
        $expectedCount = 4;

        // when
        $actual = $this->tested->getJsonFromFile(DOCUMENT_ROOT . '/data/boarding-card.json');

        // then
        $this->assertCount($expectedCount, $actual);
        $this->assertObjectHasAttribute($expected, $actual[0]);
    }
}
