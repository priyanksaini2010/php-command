
    
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