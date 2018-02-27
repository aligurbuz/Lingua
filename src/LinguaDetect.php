<?php

namespace Lingua;

/**
 * Class LinguaDetect
 * @package Lingua
 */
class LinguaDetect extends LinguaAbstract implements LinguaInterface {

    /**
     * @return mixed|string
     */
    public function set(){
        return $this->getHandler();
    }

    /**
     * @param $stream
     * @return mixed|string
     */
    public function get($stream){
        return $this->walk('get',$stream);
    }

    /**
     * @return mixed|string
     */
    public function update(){
        return 'update';
    }

    /**
     * @return mixed|string
     */
    public function delete(){
        return 'delete';
    }
}