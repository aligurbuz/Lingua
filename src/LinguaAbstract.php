<?php

namespace Lingua;

use Lingua\Traits\Config;

/**
 * Class LinguaAbstract
 * @package Lingua
 */
abstract class LinguaAbstract {

    use Config;

    /**
     * LinguaDetect constructor.
     * @param null $path
     */
    public function __construct($path=null){

        //
        $this->handler($path);
        return $this->handler;
    }

    /**
     * @return mixed
     */
    public function getHandler(){
        return $this->handler;
    }

    /**
     * @return string
     */
    public function streamHandler(){
        return $this->getHandler().'/'.$this->locale.'';
    }

    /**
     * @param $method
     * @param $stream
     * @param $param array
     * @return mixed
     */
    public function walk($method,$stream,$param){

        //
        $this->stream=$stream;
        $this->param=$param;

        //
        $process=$method.''.$this->processPrefix;
        $processClass=$this->getProcessClass($process);

        //
        return (new $processClass($this))->handle();

    }

    private function getProcessClass($process){

        //
        if(isset($this->processClasses[$process]) AND $processClasses=$this->processClasses[$process]){
            return $processClasses;
        }

        throw new \LogicException('stream handler error');
    }



}