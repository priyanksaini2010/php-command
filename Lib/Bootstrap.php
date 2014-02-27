<?php 
/**
 * This is a base bootstrap File, It will invoke Base Disptacher which will
 * include all respectivce file automatically using autoload function
 * 
 * PHP 5
 * 
 * @category Configuration
 * @package  php-command
 * @author   Priyank Saini <priyanksaini2010@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Autoload File if an object of a class is created
 * 
 * @param type $class
 * @author Priyank Saini<priyanksaini2010@gmail.com>
 * @return object Object Of the Class
 */
function __autoload($class)
{
    $filename = $class.'.php';
    $path = __DIR__;
    if (file_exists($path . '/Configuration/' . $filename)) {
        $dir = 'Configuration';
        require_once ($path . '/Configuration/' . $filename);
    } else if (file_exists($path . '/Api/' . $filename)) {
        $dir = 'Api';
        require_once ($path . '/Api/'. $filename);
    } else if (file_exists($path. '/Client/' . $filename)) {
        $dir = 'Client';
        require_once ($path . '/Client/'. $filename);
    } else  {
        $content = "File :" . $filename . " not found";
        $file = $path. "/Log/error.log";
        file_put_contents($file, date('Y-m-d h:i:s :') . $content.PHP_EOL);
        echo $content;
        exit;
    }
    $interfaces = class_implements($class,FALSE);
    foreach ($interfaces as $name) {
        if (!class_exists($name, FALSE)) {
            require_once($path. "/" . $dir . "/" . $name . ".php");
        }
    }
}
include 'Lib/Configuration/ConfigFactory.php';
include 'Lib/Configuration/ErrorHandler.php';
$errorHandler = new ErrorHandler();
set_error_handler(array($errorHandler, 'custHandler'));;
?>
