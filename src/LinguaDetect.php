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
        return 'set';
    }

    /**
     * @return mixed|string
     */
    public function get(){
        return 'get';
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