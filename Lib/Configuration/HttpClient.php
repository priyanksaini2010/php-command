<?php
/**
 * This is a class for Making Api Call And Disptching response
 * 
 * PHP 5
 * 
 * @package  Submit Issue
 * @author   Priyank Saini <priyanksaini2010@gmail.com>
 */
class HttpClient
{
    /**
     * Set Curl Chanel
     * 
     * @var resourxe
     */
    public $ch;
    
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
        return curl_exec($this->ch);
    }
    
    /**
     * Set Curl User Agent
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return void Nothing to return
     */
    public function setUserAgent()
    {
        curl_setopt($this->ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    }
    
    /**
     * Set Curl Headers
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return void Nothing to return
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
    }
    
    /**
     * Set Username and pasword for authentication
     * 
     * @param string $username Username, who is submiting issue of set domain
     * @param string $password Username, who is submiting issue of set domail
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return void Nothing to retun
     */
    public function setAuth($username, $password)
    {
        
        $credentials = $username.':'.$password;
        curl_setopt($this->ch, CURLOPT_USERPWD, $credentials);
    }
    
    /**
     * Set Body of the API request
     * 
     * @param json $name Body of the Issue
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return void Nothing to return
     */
    public function setPost($content)
    {
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $content);
    }
    
    /**
     * Set Curl Url to make request
     * 
     * @param string $url URL to make request
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return void Nothing to retyurn
     */
    public function setUrl($url)
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
    }
    
    public function getCurlInfo()
    {
        return curl_getinfo($this->ch);
    }
    
    
    public function doInstRequest($url, $data)
    {
//        pr($url);
//        die;
        $username = 'priyanksaini2010';
        $password = '#qw123pop';
        $credentials = '"'.$username.':'.$password.'';
//        $url = 'https://api.github.com/repos/priyanksaini2010/php-command/issues';
        $data = '{"title":"my-new-repo","body":"my new issue description is here"}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_USERPWD, "priyanksaini2010:#qw123pop");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
        );
        $response = curl_exec($ch);
//        pr($response);
        return $response;
    }
    public function doInstReqBit($url, $data)
    {
//      $url = 'https://bitbucket.org/api/1.0/repositories/priyanksaini2010/php-command-script-mk1/issues/';
//        $data = 'title=This is a title';
//        pr($data);
//        die;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_USERPWD, "priyanksaini2010:qw123pop");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/text',
            'Content-Length: ' . strlen($data))
        );
        $response = curl_exec($ch);

        echo '<pre>';
        print_r($response);
        exit;
    }
}

