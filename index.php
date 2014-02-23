<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
include 'Lib/Configuration/ConfigFactory.php';
include 'Lib/Configuration/ErrorHandler.php';
try{
    ConfigFactory::checkRequest();
} catch (Exception $ex) {
     echo  $ex->getMessage();
}
require_once('Lib/Bootstrap.php');

?>
