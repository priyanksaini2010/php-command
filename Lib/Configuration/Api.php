<?php
/**
 * This is a class for Preparing Api According to data provided
 * 
 * PHP 5
 * 
 * @package  Submit Issue
 * @author   Priyank Saini <priyanksaini2010@gmail.com>
 */
class Api
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
        $this->prepareRequest();
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
//        pr($this->url);
//        die;
//        $response = $client->doInstReqBit($this->url, $this->content);
//        $response = $client->doInstRequest($this->url, $this->content);
        $response =  $this->doRequest($client);
//        $reponse =  $client->getCurlInfo();
        var_dump($response);
        pr($response);
        die;
    }
    
    /**
     * Prepare content to post
     * 
     * @access protected
     * @author Priyank Saini <priyanksaini2010@gmail.com>
     * @return void Content will be set on $ccontent
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
    }
    
    /**
     * Prepare API url according to args provided
     * 
     * @access protected
     * @author Priyank Saini<priyanksaini2010@gmail.com>
     * @return void URL will be set in $url
     */
    protected function prepareUrl() 
    {
        $this->url = $this->domainConfig->url->start.$this->credentials['username']."/".$this->domainDetail['repo']."/".$this->domainConfig->url->end;
    }
    
    protected function doRequest(HttpClient $client) 
    {
        return $client->doRequest();
    }
}
