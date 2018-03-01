<?php

namespace Lingua\Lib;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * Class GetLinguaProcess
 * @package Lingua\Lib
 */
class YamlProcess {

    /**
     * @param $yamlFile null
     * @return string
     */
    public static function parse($yamlFile=null){

        try {

            return Yaml::parse(file_get_contents($yamlFile.'.yaml'));

        } catch (ParseException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }

    }

}