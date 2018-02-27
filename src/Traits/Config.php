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
    protected $handler;

    /**
     * @var string
     */
    protected $locale='en';

    /**
     * @var string
     */
    protected $processPrefix='LinguaProcess';

    /**
     * @var $stream
     */
    public $stream;

    /**
     * @var array
     */
    protected $processClasses=[
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


}