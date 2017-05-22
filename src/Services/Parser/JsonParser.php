<?php

namespace Src\Services\Parser;

/**
 * Class JsonParser
 *
 * Json parse handler class
 *
 * @package Parser
 */
class JsonParser
{

    const FILE_IS_NOT_READABLE_MESSAGE = 'File is not readable or file dont exist';

    /**
     * Read json file if exist and create a array
     *
     * @param $filePath
     * @return array
     * @throws \Exception
     */
    public function getJsonFromFile($filePath = null): array
    {
        //get config file
        if ($filePath == null) {
            $filePath = Config::get('trip_sorter')['json_file'];
        }

        // check if json file is readable
        if (!is_readable($filePath) || !is_file($filePath) || !file_exists($filePath)) {
            throw new \Exception(self::FILE_IS_NOT_READABLE_MESSAGE);
        }

        // try to get content from json file
        try {
            return self::parseJsonString(file_get_contents($filePath));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     *
     * @param String $jsonString
     * @return array $decode
     */
    public static function parseJsonString(String $jsonString): array
    {
        $decode = json_decode($jsonString);
        return $decode;
    }
}
