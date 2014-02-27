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
function pr ($data) {
    echo "<pre>";
    print_r($data);
    die;
}
require_once('Lib/Bootstrap.php');
if (ConfigFactory::getConfigVar('application', 'env') == 'development') {
    ini_set('display_errors', true);
    error_reporting(E_ALL);
}

try{
    ConfigFactory::checkRequest();
} catch (Exception $ex) {
     echo  $ex->getMessage();
}
$route = new Dispatcher();
?>
