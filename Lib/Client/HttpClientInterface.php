<?php
/**
 * This is a class for preparing curl for making request and geting response
 * 
 * PHP 5
 * 
 * @package  php-command
 * @category API
 * @author   Priyank Saini <priyanksaini2010@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 */
interface HttpClientInterface
{
    
    /**
     * This method will execute Curl and return curl response
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return mixed response from API Hit
     */
    public function doRequest();
    
    /**
     * Set Curl User Agent
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return null set user agent on curl session
     */
    public function setUserAgent();
    
    /**
     * Set Curl Headers
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return null set headers in curl session
     */
    public function setHeader($data, $format);
    
    /**
     * Set Username and pasword for authentication
     * 
     * @param string $username Username, who is submiting issue of set domain
     * @param string $password Username, who is submiting issue of set domain
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return null set auth in current curl session
     */
    public function setAuth($username, $password);
    
    /**
     * Set Body of the API request
     * 
     * @param json $name Body of the Issue
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return null set post data in current curl sesssion
     */
    public function setPost($content);
    
    /**
     * Set Curl Url to make request
     * 
     * @param string $url URL to make request
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return null set url string in current surl session
     */
    public function setUrl($url);
    
    /**
     * generates information of curl session
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return array Curl Info
     */
    public function getCurlInfo();
    
    /**
     * Stops Curl Session
     * 
     * @access public
     * @author Priyank Saini<priyanksaini2010@gmail.com>
     * @return void
     */
    public function stopCurl();
    
    
    /**
     * Get Curl Error Number
     * 
     * @access public
     * @author Priyank Saini <priyank.saini@kelltontech.com>
     * @return array Return curl error
     */
    public function getErrorNumber();
    
}

