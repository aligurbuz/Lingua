<?php

namespace Lingua;

use Lingua\Traits\Config;

/**
 * Class LinguaAbstract
 * @package Lingua
 */
abstract class LinguaAbstract {

    /**
     * Config
     */
    use Config;

    /**
     * Lingua constructor.
     * @param null $path
     */
    public function __construct($path=null){

        //The path sent the constructor
        //method by client is assigned a global variable here.
        $this->handler($path);
    }

    /**
     * @return mixed
     */
    public function getHandler(){

        //main path
        return $this->handler;
    }

    /**
     * @return string
     */
    public function streamHandler(){

        //main path specified as local
        return $this->getHandler().'/'.$this->locale.'';
    }

    /**
     * @param $method
     * @param $stream
     * @param $param array
     * @return mixed
     */
    public function walk($method,$stream,$param){

        //stream and param for client
        //it is assigned global variable
        $this->stream=$stream;
        $this->param=$param;

        //process will be called for library
        //run processClass method to call library
        $process=$method.''.$this->processPrefix;
        $processClass=$this->getProcessClass($process);

        //run handle method for library
        return (new $processClass($this))->handle();

    }

    /**
     * @param $process
     * @return mixed
     */
    private function getProcessClass($process){

        //check process class for library
        if(isset($this->processClasses[$process])){
            return $this->processClasses[$process];
        }

        //print error if there is error for process class
        throw new \LogicException('stream handler error');
    }



}