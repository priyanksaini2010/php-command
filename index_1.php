<?php 
// $url = 'https://api.github.com/users/priyanksaini2010/repos';
 $url = 'https://api.github.com/repos/priyanksaini2010/php-command/issues';

$send = array('title'=>'My Issue','body'=>'My Issues Detail');
$send = json_encode($send);
            $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $send);	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/json',
		    'Content-Length: ' . strlen($data))
		);
            $response = curl_exec($ch);
            
            echo '<pre>';
            print_r($response);exit;
 require_once('Lib/Bootstrap.php');?>
