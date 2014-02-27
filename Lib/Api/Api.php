<?php
/**
 * This is a class for Preparing Api Arguiments sent from bash command
 * 
 * PHP 5
 * 
 * @package  php-command
 * @category API
 * @author   Priyank Saini <priyanksaini2010@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Api implements ApiInterface
{
    /**
     * Username/Password For the API To call
     *
     * @var array 
     */
    protected $credentials;
    
    /**
     * Title and Body to submit
     *
     * @var array 
     */
    protected $content;
    
    /**
     * Domain and Repo Detail where Issue will post
     * 
     * @var array
     */
    protected $domainDetail;
    
    /**
     * Set Domain Configuration From INI acc to domain sent on args
     * 
     * @var object
     */
    protected $domainConfig;
    
    /**
     * Domain Url to set According to repo name and username
     *
     * @var string 
     */
    protected $url;
    
    /**
     * Response of API request
     *
     * @var array 
     */
    protected $response;
    
    /**
     * String to display after Succesfull Curl Hit
     *
     * @var String 
     */
    public $submissionStatus;
    
    /**
     * Method will configure Credentials Provided and Prepare a request
     * 
     * @param array $credentials   Username/Password To Use
     * @param array $content       Issue's Title And Content
     * @param array $domainDetails Domain And Repo slug
     * 
     * @author  Priyank Saini<priyanksaini2010@gmail.com>
     * @access  public
     * @return  type Description
     */
    public function __construct($credentials, $content, $domainDetail)
    {
        $this->content = $content;
        $this->credentials = $credentials;
        $this->domainDetail = $domainDetail;
        $this->domainConfig = ConfigFactory::getConfigVar('domain', $this->domainDetail['domain']);
        $this->submissionStatus = $this->prepareRequest();
    }
    
    /**
     * Prepare request according to the Args
     * 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     */
    public function prepareRequest()
    {
        $client = new HttpClient;
        $this->prepareContent();
        $this->prepareUrl();
        $client->setPost($this->content);
        $client->setAuth($this->credentials['username'], $this->credentials['password']);
        $client->setAuth($this->credentials['username'], $this->credentials['password']);
        $client->setHeader($this->content, $this->domainConfig->format);
        $client->setUserAgent();
        $client->setUrl($this->url);
        $this->response = $this->doRequest($client);
        if ($client->getErrorNumber() != 0) {
            $errror = new ErrorHandler();
            $errror->curlException($client->getErrorNumber());
        }
        return $response = $this->getSubmisssionStatus();
        
    }
    
    /**
     * Prepare content to post
     * 
     * @access protected
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return null Content will be set on $ccontent
     */
    protected function prepareContent()
    {
      switch ($this->domainConfig->format)
      {
          case 'json':
              $this->content = json_encode(array($this->domainConfig->title => $this->content['title'],
                                                 $this->domainConfig->content => $this->content['content']));
              break;
          case 'text':
              $this->content = $this->domainConfig->title."=".$this->content['title']."&".$this->domainConfig->content."=".$this->content['content'];
              break;
      }
      return null;
    }
    
    /**
     * Prepare API url according to args provided
     * 
     * @access protected
     * @author Priyank Saini<priyanksaini2010@gmail.com>
     * @return null
     */
    protected function prepareUrl() 
    {
        $this->url = $this->domainConfig->url->start.$this->domainDetail['repo']."/".$this->domainConfig->url->end;
        return null;
    }
    
    /**
     * Make API call For Creating new Issue
     * 
     * @param HttpClient $client
     * 
     * @return json Response from API Call
     */
    protected function doRequest(HttpClient $client) 
    {
       return $client->doRequest();
    }
    
    /**
     * Get Issue Submission Status
     * 
     * @return string Text To display 
     * @access public
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     */
    protected function getSubmisssionStatus()
    {
        $string = '';
        if (!empty($this->response)) {
            if (isset($this->response['state']) || isset($this->response['status'])) {
               $string = "Issue Submited";
            } else if (isset($this->response['message'])) {
                echo $this->response['message'];
            } else {
                $string = "Issue Submission failed";
            }
        } else {
            $string = "Issue Submission Failed";
        }
        return $string;
    }
    
}
