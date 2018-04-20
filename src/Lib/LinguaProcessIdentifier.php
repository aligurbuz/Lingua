<?php
namespace Lingua\Lib;

abstract class LinguaProcessIdentifier {

    /**
     * @var $stream
     */
    public $app;

    public $resolveStream;

    /**
     * @var $base
     */
    public $base;

    /**
     * @var array
     */
    public $streamList=[];

    /**
     * LinguaProcessIdentifier constructor.
     * @param $app \Lingua\Lingua
     */
    public function __construct($app) {
        $this->app=$app;
    }

    /**
     * @method resolve
     */
    public function resolve(){
        $this->resolveStream=ParseLinguaStream::resolveStream($this->app);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContext(){
        return $this->resolveStream;
    }

    /**
     * @return string
     */
    public function getFile(){
        return $this->app->streamHandler().'/'.$this->resolve()->getContext()->file;
    }

    /**
     * @param $yamlfile null
     * @return mixed
     */
    public function getYaml($yamlfile=null){

        //set yaml file
        $yamlFile=($yamlfile===null) ? $this->getFile() : $yamlfile;

        //read the specified stream yaml
        return YamlProcess::parse($yamlFile);
    }

    /**
     * @return mixed
     */
    public function getIndex(){
        return $this->resolve()->getContext()->index;
    }
}