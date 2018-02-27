<?php
namespace Lingua\Lib;

abstract class LinguaProcessIdentifier {

    /**
     * @var $stream
     */
    protected $streamContext;

    /**
     * LinguaProcessIdentifier constructor.
     * @param $app
     */
    public function __construct($app) {
        $this->streamContext=$app->stream;
    }
}