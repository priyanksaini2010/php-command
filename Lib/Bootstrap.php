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
 */
function __autoload($class)
{
    require_once ('Configuration/'.$class.'.php');
}

include 'Lib/Configuration/ConfigFactory.php';
include 'Lib/Configuration/ErrorHandler.php';
?>
