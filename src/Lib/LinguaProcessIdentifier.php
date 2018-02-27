<?php
namespace Lingua\Lib;

abstract class LinguaProcessIdentifier {

    /**
     * @var $method
     */
    protected $method;

    /**
     * @var $stream
     */
    protected $stream;

    /**
     * LinguaProcessIdentifier constructor.
     * @param $method
     * @param $stream
     */
    public function __construct($method,$stream) {

        $this->method=$method;
        $this->stream=$stream;
    }
}