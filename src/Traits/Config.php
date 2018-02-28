<?php

namespace Lingua\Traits;

use Lingua\Lib\GetLinguaProcess;

/**
 * Trait Config
 * @package Lingua\Traits
 */
trait Config {

    /**
     * @var $handler
     */
    public $handler;

    /**
     * @var string
     */
    public $locale='en';

    /**
     * @var array
     */
    public $include=[];

    /**
     * @var string
     */
    public $processPrefix='LinguaProcess';

    /**
     * @var $stream
     */
    public $stream;

    /**
     * @var array
     */
    public $processClasses=[
        'GetLinguaProcess'=>getLinguaProcess::class,

    ];

    /**
     * @param $handler
     */
    public function handler($handler){

        //set path for languages
        $this->handler=$handler;
    }

    /**
     * @param $locale
     * @return $this
     */
    public function locale($locale) {
        $this->locale=$locale;
        return $this;
    }

    /**
     * @param array $include
     * @return $this
     */
    public function include($include=array()){
        $this->include=$include;
        return $this;
    }


}