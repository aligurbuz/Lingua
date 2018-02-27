<?php

namespace Lingua;

use Lingua\Traits\Config;

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

}