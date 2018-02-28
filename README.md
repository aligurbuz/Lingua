# Lingua
Easily integrate and manage your language files.

# Introduction:
> It is a package that you can extensively manage your language files in the format of yaml. Under this package you can easily include your language files in your application code as defined in the package usage.

# Installation:
```bash
$ composer require aligurbuz/lingua
```

# Usage

> Include your Composer vendor autoload file and use the Lingua class as follows.

```php

require_once '../vendor/autoload.php';
use Lingua\Lingua;

```

> Include your Composer vendor autoload file and use the Lingua class as follows.The directory path you will assign to constructor object of the lingua class
                                                                                 is the main path to your language files. As long as you do not specify the locale method, the "en" directory is automatically appended to the main path.

```php

//it is set to the as en value of default locale in the langdir directory.
$lang=(new Lingua('path/to/langDir'));

//It prints all the keys in message.yaml (in that path/to/langDir/en)
echo $lang->get('message');

//it is set to the as fr in the langdir directory.
//It prints all the keys in message.yaml (in that path/to/langDir/fr)
echo $lang->locale('fr')->get('message');

//It prints key called foo in message.yaml (in that path/to/langDir/en)
echo $lang->get('message.foo');

//It prints keys specified in array as parameters in message.yaml (in that path/to/langDir/en)
echo $lang->get('message',['foo','bar']);

//if specified exclude as key in array as parameters in message.yaml (in that path/to/langDir/en)
//In this case, the strings in the exclude array are removed from the called file.
echo $lang->get('message',['exclude'=>['foo']);


```


> Sometimes when you search for a key in a language file
  you may want to determine if it is also included in a file that is automatically included.
   If the called key does not exist in the specified file, it will check whether it exists automatically in the included file.
       In fact, lingua will automatically join the two files here. The key you are looking for will be searched in a single array.

```php

//It prints all the keys in message.yaml and default.yaml (in that path/to/langDir/en)
echo $lang->include(['default'])->get('message');

//It prints key that in default.yaml if there is no key specified in message.yaml (in that path/to/langDir/en)
echo $lang->include(['default'])->get('message.foo');

```