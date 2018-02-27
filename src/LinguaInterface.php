<?php

namespace Lingua;

interface LinguaInterface {

    /**
     * @return mixed
     */
    public function set();

    /**
     * @param $stream
     * @return mixed
     */
    public function get($stream);

    /**
     * @return mixed
     */
    public function update();

    /**
     * @return mixed
     */
    public function delete();
}