<?php

namespace Lingua\Lib;

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
     * @var array
     */
    private $streamList=[];

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

        //we check for automatic files to be included.
        //check index for stream
        $realParseFile=$this->checkMultipleParseFile();
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

    }

    /**
     * @return array
     */
    private function checkMultipleParseFile(){

        $includeFile=$this->addIncludeFile($this->getYaml());
        $includeDirFile=$this->addIncludeDirFile();
        return array_merge($includeFile,$includeDirFile);
    }

    /**
     * @param $yamlfile null
     * @return mixed
     */
    private function getYaml($yamlfile=null){

        //set yaml file
        $yamlFile=($yamlfile===null) ? $this->app->getFile() : $yamlfile;

        //read the specified stream yaml
        return YamlProcess::parse($yamlFile);
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
                $this->loopStreamHandler($this->addStreamHandler($includeValue));
            }
        }

        return array_merge($parseFile,$this->streamList);
    }

    /**
     * @return array
     */
    private function addIncludeDirFile(){

        $parseFile=[];

        //we take the variable of the file to be included.
        $include=$this->app->app->includeDir;

        //check include array
        if(count($include)>0){

            //loop for include array
            foreach ($include as $includeDirValue){

                //take files with glob for include directory
                foreach (glob("".$this->addStreamHandler($includeDirValue)."/*.yaml") as $yamlFiles) {

                    $this->loopStreamHandler($yamlFiles);
                    $parseFile=$this->streamList;
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
                    if(isset($param['exclude']) && !in_array($key,$param['exclude'])){
                        $list[$key]=$value;
                    }
                }
            }

            return $list;
        }

        //if there is no param array
        return call_user_func($callback);
    }

    /**
     * @param $dir
     * @return string
     */
    private function addStreamHandler($dir){
        return $this->app->app->streamHandler().'/'.$dir;
    }

    /**
     * @param $dir
     * @return void
     */
    private function loopStreamHandler($dir){

        //stream handler for yaml parse
        $loopStreamHandler=$this->getYaml(str_replace('.yaml','',$dir));

        foreach ($loopStreamHandler as $key=>$value){
            $this->streamList[$key]=$value;
        }
    }
}