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

        //The Symfony Yaml component is very simple and consists of two main classes:
        //one parses YAML strings (Parser), and the other dumps a PHP array to a YAML string (Dumper)
        //The parse() method parses a YAML string and converts it to a PHP array
        if(file_exists($yamlFile=$yamlFile.'.yaml')){
            return Yaml::parse(file_get_contents($yamlFile));
        }

    }

}