<?php
namespace Src\Helper;

use Exception;

/**
 * Config class, helper class to get
 * simply config variables from Config files
 *
 * Class Config
 * @package Src\Helper
 */
class Config
{
    /**
     * @param $config
     * @return mixed
     * @throws Exception
     */
    public static function get($config)
    {
        $configFile = DOCUMENT_ROOT . '/configs/' . $config . '.php';
        if (!file_exists($configFile)) {
            throw new Exception("Config File not found.");
        }
        $config = include($configFile);
        return $config;
    }
}
