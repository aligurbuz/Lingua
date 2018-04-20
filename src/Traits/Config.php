<?php

namespace Lingua\Traits;

use Lingua\Lib\GetLinguaProcess;

/**
 * Trait Config
 * @package Lingua\Traits
 */
trait Config {

    /**
     * @var string
     */
    public $langFileExtension='yaml';

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
     * @var array
     */
    public $includeDir=[];

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
    public $param=array();


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

    /**
     * @param array $include
     * @return $this
     */
    public function includeDir($include=array()){
        $this->includeDir=$include;
        return $this;
    }

    /**
     * @param $data
     * @return bool
     */
    public function checkArrayInDirectory($data){
        return (is_array($data) AND count($data)>0) ? true : false;
    }

    /**
     * @param null $file
     * @return mixed
     */
    public function stripLangFileExtension($file=null){
        return str_replace('.'.$this->langFileExtension,'',$file);
    }


}