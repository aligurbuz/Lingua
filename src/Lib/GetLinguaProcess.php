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
        return (new ResolveStreamContext($this))->read();
    }

}