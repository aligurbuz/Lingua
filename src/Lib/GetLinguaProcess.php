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
        $read=(new ResolveStreamContext($this))->read();
        print_r($read);
    }

}