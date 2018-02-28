<?php

namespace Lingua\Lib;

class ParseLinguaStream {

    /**
     * @param $app \Lingua\Lingua
     * @return mixed
     */
    public static function resolveStream($app){

        //
        $streamParse=explode(".",$app->stream);

        //
        $streamObject=[
          'file'=>$streamParse[0],
          'index'=>(isset($streamParse[1])) ? $streamParse[1] : null
        ];

        return (object)$streamObject;
    }

}