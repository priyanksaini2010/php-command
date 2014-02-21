<?php
/**
 * This file will set debug level and database connection according to the 
 * environment set in config.ini 
 * 
 * PHP 5.3.8
 * 
 * @package  Command App
 * @category Configuration
 * @author   Priyank Saini<priyank.saini@kelltontech.com>
 */
switch (ConfigFactory::getConfigVar('application','env')) {
    case 'development':
        error_reporting(E_ALL);
        break;
    case 'staging':
        error_reporting(0);
        break;
    case 'production':
        error_reporting(0);
        break;
    default:
        exit('The application environment is not set correctly.');
}
?>
