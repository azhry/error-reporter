# Error Reporter
A library class for generating error and report it as file for post-deployment PHP web application. This library is based on https://github.com/appleboy/CodeIgniter-Log-Library, but i modified it for my own purpose and added more functionalities.

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
