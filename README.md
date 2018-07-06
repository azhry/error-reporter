# Error Reporter
A simple library class for generating error and report it as file for post-deployment PHP web application. This library is based on https://github.com/appleboy/CodeIgniter-Log-Library, but i modified it and added more functionalities. This library is useful for developers who want to maintain their website, and only display the error message to developers, not display it to the public. You also can use it to prevent your website from attackers doing <a href="https://whatis.techtarget.com/definition/active-reconnaissance">active reconnaissance</a>(hopefully!)

### Version
Version 1.0 beta.

## Basic Usage
```php
<?php
require_once 'Error_reporter.php';

$reporter = new Error_reporter();
$reporter->toggle_error(0); // call ini_set behind the scene
$error_list = $reporter->get_error_list();
foreach ($error_list as $error)
{
  echo 'Errno: ' . $error->errno . '<br>';
  echo 'Errtype: ' . $error->errtype . '<br>';
  echo 'Errstr: ' . $error->errstr . '<br>';
  echo 'Errfile: ' . $error->errfile . '<br>';
  echo 'Errline: ' . $error->errline . '<br>';
  echo 'User agent: ' . $error->user_agent . '<br>';
  echo 'IP address: ' . $error->ip_address . '<br>';
  echo 'Time: ' . $error->time . '<br>';
}
```

## Method List
| Method Name | Return | Description |
| ----------- | ------ | ----------- |
| <b><i>get_error_list()</i></b> | <i>array</i> | Get the list of errors from `error.log` |
| <b><i>get_exception_list()</i></b> | <i>array</i> | Get the list of exceptions from `exception.log` |
| <b><i>toggle_error($status)</i></b> | <i>void</i> | Toggle error message. 1 = display, 0 = hide |
| <b><i>enable_error_handler()</i></b> | <i>void</i> | Enable custom `error_handler()` method |
| <b><i>disable_error_handler()</i></b> | <i>void</i> | Disable custom `error_handler()` method |
| <b><i>enable_exception_handler()</i></b> | <i>void</i> | Enable custom `exception_handler()` method |
| <b><i>disable_exception_handler()</i></b> | <i>void</i> | Disable custom `exception_handler()` method |


### Author
Azhary Arliansyah <<arliansyah_azhary@yahoo.com>>
