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
class HttpClient implements HttpClientInterface
{
    /**
     * Set Curl Channel
     * 
     * @var resourxc
     */
    public $ch;
    
    /**
     * Base contructor will start curl session as soon object is created
     * 
     * @access public
     * @author Priyank Saini<priyanksaini2010@gmail.com>
     */
    public function __construct() 
    {
        $this->ch = curl_init();
    }
    
    /**
     * This method will execute Curl and return curl response
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return mixed response from API Hit
     */
    public function doRequest()
    {
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        return curl_exec($this->ch);
    }
    
    /**
     * Set Curl User Agent
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return null set user agent on curl session
     */
    public function setUserAgent()
    {
        curl_setopt($this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        return null;
    }
    
    /**
     * Set Curl Headers
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return null set headers in curl session
     */
    public function setHeader($data, $format)
    {
        switch ($format) {
            case 'json':
                $header = 'Content-Type: application/json';
                break;
            case 'text':
                $header = 'Content-Type: application/text';
                break;
        }
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
            $header,
            'Content-Length: ' . strlen($data))
        );
        return null;
    }
    
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
    public function setAuth($username, $password)
    {
        
        $credentials = $username.':'.$password;
        curl_setopt($this->ch, CURLOPT_USERPWD, $credentials);
        return null;
    }
    
    /**
     * Set Body of the API request
     * 
     * @param json $name Body of the Issue
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return null set post data in current curl sesssion
     */
    public function setPost($content)
    {
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $content);
        return null;
    }
    
    /**
     * Set Curl Url to make request
     * 
     * @param string $url URL to make request
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return null set url string in current surl session
     */
    public function setUrl($url)
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        return null;
    }
    
    /**
     * generates information of curl session
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return array Curl Info
     */
    public function getCurlInfo()
    {
        return curl_getinfo($this->ch);
    }
    
    /**
     * Stops Curl Session
     * 
     * @access public
     * @author Priyank Saini<priyanksaini2010@gmail.com>
     * @return null
     */
    public function stopCurl()
    {
        curl_close($this->ch);
        return null;
    }
    
    /**
     * Get Curl Error Number
     * 
     * @access public
     * @author Priyank Saini <priyank.saini@kelltontech.com>
     * @return array Return curl error
     */
    public function getErrorNumber()
    {
        return curl_errno($this->ch);
    }
}

