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
if (isset($route->api->submissionStatus) && $route->api->submissionStatus) {
    if (is_string($route->api->submissionStatus)) {
        echo $route->api->submissionStatus. PHP_EOL;
    } else {
        echo '<pre>';
        $route->api->submissionStatus;
        echo '</pre>';
        echo PHP_EOL;
    }
} else {
    echo 'Unable to Submit Issue. Please Check Your credentials And Repo URL'. PHP_EOL;
}
?>
