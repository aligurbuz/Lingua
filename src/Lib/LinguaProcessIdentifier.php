<?php
namespace Lingua\Lib;

abstract class LinguaProcessIdentifier {

    /**
     * @var $stream
     */
    public $app;

    public $resolveStream;

    /**
     * LinguaProcessIdentifier constructor.
     * @param $app \Lingua\Lingua
     */
    public function __construct($app) {
        $this->app=$app;
    }

    /**
     * @method resolve
     */
    public function resolve(){
        $this->resolveStream=ParseLinguaStream::resolveStream($this->app);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContext(){
        return $this->resolveStream;
    }

    /**
     * @return string
     */
    public function getFile(){
        return $this->app->streamHandler().'/'.$this->resolve()->getContext()->file;
    }

    /**
     * @return mixed
     */
    public function getIndex(){
        return $this->resolve()->getContext()->index;
    }
}