<?php

namespace Lingua;

use Lingua\Traits\Config;
use Lingua\Lib\getLinguaProcess;

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
     * @return mixed
     */
    public function walk($method,$stream){

        //
        $process=$method.''.$this->processPrefix;
        return (new $process($method,$stream))->handle();
    }


}