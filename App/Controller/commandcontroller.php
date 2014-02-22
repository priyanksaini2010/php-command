<?php

class commandcontroller
{
    public function index()
    {
        die('I am in app');
    }
    
    public function run()
    {
	echo "hello";
        pr($this->githubRequest());
        die('I am in app');
    }
    

    public function githubRequest()
    {
        phpinfo();
            $url = 'https://api.github.com/users/priyanksaini2010/repos';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_TIMEOUT, 9000);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300000);
            curl_setopt($ch, CURLOPT_FAILONERROR, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 2);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            $response = curl_exec($ch);
            $info = curl_getinfo($ch);
            echo '<pre>';
            var_dump($response);exit;
            return $response;
	}
}
