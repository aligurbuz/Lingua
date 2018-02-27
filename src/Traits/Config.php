<?php

namespace Lingua\Traits;

/**
 * Trait Config
 * @package Lingua\Traits
 */
trait Config {

    /**
     * @var $handler
     */
    protected $handler;

    /**
     * @param $handler
     */
    public function handler($handler){

        //set path for languages
        $this->handler=$handler;
    }

}