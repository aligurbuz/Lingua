<?php

namespace Lingua\Lib;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * Class ResolveStreamContext
 * @package Lingua\Lib
 */
class ResolveStreamContext {

    /**
     * @var $app
     */
    protected $app;

    /**
     * ResolveStreamContext constructor.
     * @param $app \Lingua\Lib\GetLinguaProcess
     */
    public function __construct($app) {
        $this->app=$app;
    }

    /**
     * @return mixed
     */
    public function read(){

        try {

            //
            $parseFile=Yaml::parse($this->app->getFile().'.yaml');
            $realParseFile=$this->addIncludeFile($parseFile);
            $index=$this->app->getIndex();

            if($index===null){
                return $realParseFile;
            }
            return $realParseFile[$index];

        } catch (ParseException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }
    }

    /**
     * @param $parseFile
     * @return array
     */
    private function addIncludeFile($parseFile){

        //
        $include=$this->app->app->include;

        if(count($include)>0){
            foreach ($include as $includeValue){

                //
                $includeParseFile=Yaml::parse($this->app->app->streamHandler().'/'.$includeValue.'.yaml');

                foreach ($includeParseFile as $key=>$value){
                    $parseFile[$key]=$value;
                }
            }
            return $parseFile;

        }
    }
}