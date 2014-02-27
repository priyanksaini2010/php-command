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
class ErrorHandler implements ErrorHandlerInterface
{
    
    /**
     * This method will Throw Bad Request Exception
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @throws Bad Request Exception
     */
    public function badRequest()
    {
        $content = "Bad Request".PHP_EOL." Please enter following command for help:".PHP_EOL."submit_issues -help";
        throw new Exception('Bad Request'.PHP_EOL);
        exit;
    }
    
    /**
     * This method will Throw Bad Username/Password Exception
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @throws Bad Request Exception
     */
    public function badAuth()
    {
        throw new Exception('Username Or Pasword Not Provided.'.PHP_EOL);
        exit;
    }
    
    /**
     * This method will Throw Bad Domain Exception
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @throws Bad Request Exception
     */
    public function badDomain()
    {
        throw new Exception('Domain Not Registered.'.PHP_EOL);
        exit;
    }
    
    /**
     * This method will Throw Bad Domain Exception
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @throws Bad Request Exception
     */
    public function badContent()
    {
        throw new Exception('Title and Body Of Issue is required.'.PHP_EOL);
        exit;
    }
    
    /**
     * Method to throw exception if curl error occcured
     * 
     * @param integer $curlErrNo Curl Error Number
     * 
     * @throws Exception
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return void Nothing to return just Exception
     */
    public function curlException($curlErrNo)
    {
        throw new Exception('Curl Error #'.$curlErrNo.' has occured.'.PHP_EOL);
        exit;
    }
    
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
    public function custHandler($errno, $errstr, $errfile, $errline) 
    {
        $filename = dirname(__DIR__)."/Log/error.log";
        if (file_exists($filename)) {
            $filePermission = substr(sprintf('%o', fileperms($filename)), -4);
            if ($filePermission != 0777) {
                chmod($filename, 0777);
            }
        }
        switch ($errno) {
            case E_NOTICE:
                $content = 'Notice: '.$errstr.' at '.$errfile.' line number:'.$errline;
                file_put_contents($filename, date('Y-m-d h:i:s :').$content.PHP_EOL, FILE_APPEND);
                echo $content;
                break;
            case E_USER_NOTICE:
                $content = 'Notice: '.$errstr.' at '.$errfile.' line number:'.$errline;
                file_put_contents($filename, date('Y-m-d h:i:s :').$content.PHP_EOL, FILE_APPEND);
                echo $content;
                break;
            case E_DEPRECATED: 
                $content = 'Warning: '.$errstr.' at '.$errfile.' line number:'.$errline;
                file_put_contents($filename, date('Y-m-d h:i:s :').$content.PHP_EOL, FILE_APPEND);
                echo $content;
                break;
            case E_USER_DEPRECATED:
                $content = 'Warning: '.$errstr.' at '.$errfile.' line number:'.$errline;
                file_put_contents($filename, date('Y-m-d h:i:s :').$content.PHP_EOL, FILE_APPEND);
                echo $content;
                break;
            case E_STRICT:
                $content = 'Notice: '.$errstr.' at '.$errfile.' line number:'.$errline;
                file_put_contents($filename, date('Y-m-d h:i:s :').$content.PHP_EOL, FILE_APPEND);
                echo $content;
                break;
            case E_WARNING:
                $content = 'Warning: '.$errstr.' at '.$errfile.' line number:'.$errline;
                file_put_contents($filename, date('Y-m-d h:i:s :').$content.PHP_EOL, FILE_APPEND);
                echo $content;
                break;
            case E_USER_WARNING:
                $content = 'Warning: '.$errstr.' at '.$errfile.' line number:'.$errline;
                file_put_contents($filename, date('Y-m-d h:i:s :').$content.PHP_EOL, FILE_APPEND);
                echo $content;
                break;

            case E_ERROR:
                $content = 'FATAL error: '.$errstr.' at '.$errfile.' line number:'.$errline;
                file_put_contents($filename, date('Y-m-d h:i:s :').$content.PHP_EOL);
                break;
            case E_USER_ERROR:
                $content = 'FATAL error: '.$errstr.' at '.$errfile.' line number:'.$errline;
                file_put_contents($filename, date('Y-m-d h:i:s :').$content.PHP_EOL);
                exit($content);
                break;
            default:
                $content = 'Unknown error: '.$errstr.' at '.$errfile.' line number:'.$errline;
                file_put_contents($filename, date('Y-m-d h:i:s :').$content.PHP_EOL);
                exit($content);
                break;
        }
       
    }

}
?>
