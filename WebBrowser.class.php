class WebBrowser {
  public $user_agent = '';
  public $cookie = '';
  public $protocol = '';
  public $domain = '';
  public $desthost = '';
  public $username = '';
  public $password = '';
  public $port = '';
  public $uri = '';
  public $query_string = '';
  public $anchor = '';
  public $rerferer = '';
  public $method = '';
  
  public function __contruct() {
    $this->user_agent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.8; rv:26.0) Gecko/20100101 Firefox/26.0';
    $this->cookie = '';
    $this->setURL('http://www.google.com');
  }
  
  public function setURL(url) {
    // parsing URL to protocol, host, username, password, port, URI, query string
    $regexUrl = "((https?|ftp)\:\/\/)?"; // SCHEME 
    $regexUrl .= "([a-zA-Z0-9+!*(),;?&=\$_.-]+(\:[a-zA-Z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass 
    $regexUrl .= "([a-zA-Z0-9-]+)\.([a-zA-Z]{2,3})";  // Host or IP 
    $regexUrl .= "(\:[0-9]{2,5})?"; // Port 
    $regexUrl .= "(\/([a-zA-Z0-9+\$_-]\.?)+)*\/?"; // Path 
    $regexUrl .= "(\?[a-zA-Z+&\$_.-][a-zA-Z0-9;:@&%=+\/\$_.-]*)?"; // GET Query 
    $regexUrl .= "(#[a-zA-Z_.-][a-zA-Z0-9+\$_.-]*)?"; // Anchor
    if(preg_match_all("/$regexUrl/", $url, $matches, PREG_PATTERN_ORDER))
    {
      try
        {
            foreach($matches[0] as $urlToTrim1)
            {
                $url= $urlToTrim1;
                echo $url;
            }
        }
        catch(Exception $e)
        {
            $url="-1";
        }
    }
  }
  
//  public function resolveDomain() {
//    if ($this->domain != '') {
//      $temp_array = gethostbynamel($this->domain);
//      if ($temp_array) $this->desthost = $temp_array[0];
//    }
//  }
  
  public function getWebPage() {
    $fh = fsockopen($this->domain, 80, $errno, $errstr, 30);
    if (!fh) {
      echo "$errstr ($errno)<br />\n";
    } else {
      $buf = "GET $this->uri HTTP/1.1\r\n";
      $buf .= "Host: $this->domain\r\n";
      $buf .= "User-Agent: $this->user_agent\r\n";
      if ($this->cookie != '') $buf .= "Cookie: $this->cookie\r\n";
      if ($this->referer != '') $buf .= "Referer: $this->referer\r\n";
      
    }
  }
  
  public function postData() {
    $fh = fsockopen($this->domain, 80, $errno, $errstr, 30);
    if (!fh) {
      echo "$errstr ($errno)<br />\n";
    } else {
      $buf = "POST $this->uri HTTP/1.1\r\n";
      $buf .= "Host: $this->domain\r\n";
      $buf .= "User-Agent: $this->user_agent\r\n";
      if ($this->cookie != '') $buf .= "Cookie: $this->cookie\r\n";
      if ($this->referer != '') $buf .= "Referer: $this->referer\r\n";
      
    }
  }
}
