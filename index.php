<?php
/**
 * This is a base File called from the bash file
 * 
 * PHP 5
 * 
 * @category Configuration
 * @package  php-command
 * @author   Priyank Saini <priyanksaini2010@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 */
function pr($data)
{
    echo "<pre>";
    print_r($data);
    echo "<pre>";
}
ini_set('display_errors', true);
error_reporting(E_ALL);
require_once('Lib/Bootstrap.php');
try{
    ConfigFactory::checkRequest();
} catch (Exception $ex) {
     echo  $ex->getMessage();
}

$route = new Dispatcher();
?>
