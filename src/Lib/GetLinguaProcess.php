<?php

namespace Lingua\Lib;

/**
 * Class GetLinguaProcess
 * @package Lingua\Lib
 */
class GetLinguaProcess extends LinguaProcessIdentifier {

    public function handle(){

        return $this->streamContext;
    }

}