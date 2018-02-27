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
     * @var string
     */
    protected $locale='en';

    /**
     * @var string
     */
    protected $processPrefix='LinguaProcess';

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