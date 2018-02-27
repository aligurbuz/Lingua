<?php

/**
 * composer vendor autoload.
 * For libraries that specify autoload information, Composer generates a vendor/autoload.php file.
 * You can simply include this file and start using the classes that those libraries provide without any extra work
 * system main skeleton
 * return autoload file
 */
require_once '../vendor/autoload.php';

use Lingua\LinguaDetect;

echo (new LinguaDetect())->test();