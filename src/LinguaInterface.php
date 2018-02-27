<?php

namespace Lingua;

interface LinguaInterface {

    /**
     * @return mixed
     */
    public function set();

    /**
     * @return mixed
     */
    public function get();

    /**
     * @return mixed
     */
    public function update();

    /**
     * @return mixed
     */
    public function delete();
}