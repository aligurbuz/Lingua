<?php

namespace Lingua\Lib;

use Lingua\Lingua;

/**
 * Class ResolveStreamGetContext
 * @package Lingua\Lib
 */
class ResolveStreamGetContext {

    /**
     * @var $app
     */
    protected $app;

    /**
     * @var $base \Lingua\Lingua
     */
    protected $base;

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
        $this->base=$this->app->app;
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

        //the included files and the files in the directory are merging here.
        //This includes the general features of the system.
        $includeFile=$this->addIncludeFile($this->app->getYaml());
        $includeDirFile=$this->addIncludeDirFile();
        return array_merge($includeFile,$includeDirFile);
    }

    /**
     * @param $parseFile
     * @return array
     */
    private function addIncludeFile($parseFile){

        //we take the variable of the file to be included.
        $include=$this->base->include;

        //check include array
        if($this->base->checkArrayInDirectory($include)){

            //loop for include array
            foreach ($include as $includeValue){
                $this->loopStreamHandler($this->addStreamHandler($includeValue));
            }
        }

        // if the parseFile value is null,
        // we have to assign this value an empty value by default for array_merge.
        if($parseFile===null) $parseFile=[];

        //we are merging the files included in
        //the file requested by default with the file to be included.
        return array_merge($parseFile,$this->streamList);
    }

    /**
     * @return array
     */
    private function addIncludeDirFile(){

        $parseFile=[];

        //we take the variable of the file to be included.
        $include=$this->base->includeDir;

        //check include array
        if($this->base->checkArrayInDirectory($include)){

            //loop for include array
            foreach ($include as $includeDirValue){

                //we use glob to get all the language files in the specified directory.
                //path globPathPattern
                $globPathPattern=$this->addStreamHandler($includeDirValue)."/*.".$this->base->langFileExtension;
                $parseFile=$this->getPathsWithGlob($globPathPattern);
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
        if(count($param=$this->base->param)>0){

            $list=[];
            foreach ($file as $key=>$value){

                //check exclude for param array
                if(!isset($param['exclude']) && in_array($key,$param)){
                    $list[$key]=$value;
                }
                else{

                    //if the specified key is not in the exclude list, we get it again.
                    if(!in_array($key,$param['exclude'])) $list[$key]=$value;
                }
            }

            //return list
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

        //With the streamHandler method we get the directory path.
        return $this->base->streamHandler().'/'.$dir;
    }

    /**
     * @param $dir
     * @return void
     */
    private function loopStreamHandler($dir){

        //stream handler for yaml parse
        $loopStreamHandler=$this->app->getYaml($this->base->stripLangFileExtension($dir));

        //if loopStreamHandler is array
        if($this->base->checkArrayInDirectory($loopStreamHandler)){

            //set as key and value to stream list object
            foreach ($loopStreamHandler as $key=>$value){
                $this->streamList[$key]=$value;
            }
        }

    }

    /**
     * @param null $path
     * @return array
     */
    private function getPathsWithGlob($path=null){

        //loop files with glob
        foreach (glob($path) as $files) {

            //After recording the stream list objesine keys,
            //we return the streamlist object.
            $this->loopStreamHandler($files);
            return $this->streamList;
        }
    }
}
