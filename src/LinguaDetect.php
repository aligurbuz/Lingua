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
     * @param $param array
     * @return mixed|string
     */
    public function get($stream,$param=array()){
        return $this->walk('Get',$stream,$param);
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