<?php

namespace Lingua\Lib;

/**
 * Class GetLinguaProcess
 * @package Lingua\Lib
 */
class GetLinguaProcess extends LinguaProcessIdentifier {

    /**
     * @return string
     */
    public function handle(){

        //The get method for lingua starts here.
        //To read from the requested language files,
        //the system reads the read method of the resolveStreamContext class.
        return (new ResolveStreamGetContext($this))->read();
    }



}