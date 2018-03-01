<?php

/**
 * composer vendor autoload.
 * For libraries that specify autoload information, Composer generates a vendor/autoload.php file.
 * You can simply include this file and start using the classes that those libraries provide without any extra work
 * system main skeleton
 * return autoload file
 */
require_once '../vendor/autoload.php';

use Lingua\Lingua;

$realPath=__DIR__.'/../lang';

$result=(new Lingua($realPath))->includeDir(['load'])->include(['default'])->get('message');
echo '<pre>';
print_r($result);
echo '</pre>';


