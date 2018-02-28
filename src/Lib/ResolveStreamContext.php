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

            //we check for automatic files to be included.
            //check index for stream
            $realParseFile=$this->addIncludeFile($this->getYaml());
            $index=$this->app->getIndex();

            //If the parameter is sent by the client.
            //In this case, we do parameter checking for the stream.
            return $this->checkParamForStream($realParseFile,function() use ($realParseFile,$index) {

                //if index is null
                //all keys
                if($index===null){
                    return $realParseFile;
                }

                //if index is not null,then return the specified key
                return (isset($realParseFile[$index])) ? $realParseFile[$index] : null;
            });

        } catch (ParseException $e) {
            throw new \InvalidArgumentException($e->getMessage());
        }
    }

    /**
     * @param $yamlfile null
     * @return mixed
     */
    private function getYaml($yamlfile=null){

        //set yaml file
        $yamlFile=($yamlfile===null) ? $this->app->getFile() : $yamlfile;

        //read the specified stream yaml
        return Yaml::parse($yamlFile.'.yaml');
    }

    /**
     * @param $parseFile
     * @return array
     */
    private function addIncludeFile($parseFile){

        //we take the variable of the file to be included.
        $include=$this->app->app->include;

        //check include array
        if(count($include)>0){

            //loop for include array
            foreach ($include as $includeValue){

                //parse for yaml the files will be included
                $includeParseFile=$this->getYaml($this->app->app->streamHandler().'/'.$includeValue);

                foreach ($includeParseFile as $key=>$value){
                    $parseFile[$key]=$value;
                }
            }
        }

        return $parseFile;
    }


    /**
     * @param $file
     * @param callable $callback
     * @return mixed
     */
    private function checkParamForStream($file,callable $callback){

        //if available param array
        if(count($param=$this->app->app->param)>0){

            $list=[];
            foreach ($file as $key=>$value){

                //check exclude for param array
                if(!isset($param['exclude']) && in_array($key,$param)){
                    $list[$key]=$value;
                }
                else{
                    if(!in_array($key,$param['exclude'])){
                        $list[$key]=$value;
                    }
                }
            }

            return $list;
        }

        //if there is no param array
        return call_user_func($callback);
    }
}