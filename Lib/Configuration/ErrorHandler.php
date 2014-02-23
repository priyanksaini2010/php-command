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
class ErrorHandler
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
        throw new Exception('Bad Request');
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
        throw new Exception('Username Or Pasword Not Provided.');
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
        throw new Exception('Domain Not Registered.');
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
        throw new Exception('Title and Body Of Issue is required.');
    }
}
?>
