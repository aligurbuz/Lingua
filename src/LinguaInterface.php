<?php

namespace Lingua;

interface LinguaInterface {

    /**
     * @param $stream
     * @return mixed
     */
    public function get($stream);

    /**
     * @return mixed
     */
    public function set();

    /**
     * @return mixed
     */
    public function update();

    /**
     * @return mixed
     */
    public function delete();
}