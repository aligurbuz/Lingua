# Lingua
Easily integrate and manage your language files.

# Introduction:
> It is a package that you can extensively manage your language files in the format of yaml. Under this package you can easily include your language files in your application code as defined in the package usage.

# Installation:
> Composer require aligurbuz/lingua

# Usage

> Include your Composer vendor autoload file and use the Lingua class as follows.

```php

require_once '../vendor/autoload.php';
use Lingua\LinguaDetect as Lingua;

```

> Include your Composer vendor autoload file and use the Lingua class as follows.You will assign the constructor object of the lingua class to the directory path
                                                                                 is the main path to your language files. As long as you do not specify the locale method, the en directory is automatically appended to the "en" path.

```php

//it is set to the as en value of default locale in the langdir directory.
$lang=(new Lingua('path/to/langDir'));

//It prints all the keys in message.yaml (in that path/to/langDir/en)
echo $lang->get('message');


```

```php

//it is set to the as fr in the langdir directory.
//It prints all the keys in message.yaml (in that path/to/langDir/fr)
echo (new Lingua('path/to/langDir'))->locale('fr')->get('message');

```