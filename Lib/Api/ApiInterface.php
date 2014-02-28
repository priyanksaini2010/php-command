<?php
/**
 * This is Interface for API Class
 * 
 * PHP 5
 * 
 * @package  php-command
 * @category API
 * @author   Priyank Saini <priyanksaini2010@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 */
interface ApiInterface
{
    
    /**
     * Prepare request according to the Args
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     */
    public function prepareRequest();
    
}
