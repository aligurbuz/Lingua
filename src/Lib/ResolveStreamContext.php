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

            return $this->checkParamForStream($realParseFile,function() use ($realParseFile,$index) {

                if($index===null){
                    return $realParseFile;
                }
                return $realParseFile[$index];
            });


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


    /**
     * @param $file
     * @param callable $callback
     * @return mixed
     */
    private function checkParamForStream($file,callable $callback){

        //
        if(count($param=$this->app->app->param)>0){

            $list=[];
            foreach ($file as $key=>$value){
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

        return call_user_func($callback);
    }
}