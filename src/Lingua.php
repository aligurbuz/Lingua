<?php

namespace Lingua;

/**
 * Class Lingua
 * @package Lingua
 */
class Lingua extends LinguaAbstract implements LinguaInterface {

    /**
     * @param $stream
     * @param $param array
     * @return mixed|string
     */
    public function get($stream,$param=array()){

        //The get method is the method used to get
        //the key from the specified file for lingua.
        return $this->walk('Get',$stream,$param);
    }

    /**
     * @return mixed|string
     */
    public function set(){
        return 'set';
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