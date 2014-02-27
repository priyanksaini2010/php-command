<?php
/**
 * This is a class for haldling Error Encounterd in the Application
 * 
 * PHP 5
 * 
 * @category Error Handling
 * @package  php-command
 * @author   Priyank Saini <priyanksaini2010@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 */
interface ErrorHandler
{
    /**
     * Custom error handler logs All error of Application to error log
     * and render in custon style
     * 
     * @param int     $errno   Error Number
     * @param string  $errstr  Error Message
     * @param strinng $errfile Error in File
     * @param int     $errline Error On Line Number
     * 
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @access public
     */
    public function custHandler($errno, $errstr, $errfile, $errline);

}
?>
