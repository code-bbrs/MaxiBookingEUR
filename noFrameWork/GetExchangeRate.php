<?php
Class GetExchangeRate {

// Attributs:
private $url;
private $content;
private $currKey;
private $vals;
private $exchangeRate;

// Methods:
function __construct($url) {
	$this->setUrl($url);
	$this->content();
	$this->dataFormat();
	$this->exchangeRate();
}

protected function setUrl(array $url) {
	$this->url = $url;
}


// Return an array of values ​​from a '.json' or '.xml' external file:
protected function content() {
	$url = $this->url;
	foreach ($url as $urls) {
		$u = $urls[1];
		if( $content = file_get_contents($u) ) {
			$content = trim( $content );
			$this->content = $content;
			$this->currKey = $urls[0];
			return true; 
		}
	} return false;
}


// Return php array:
protected function dataFormat() {
	
	$content = $this->content;
	
	$vals = json_decode($content, true);
	if($vals) {
		$this->vals = $vals;
		return true;
	}
	
	$p = xml_parser_create();
	xml_parse_into_struct($p, $content, $vals, $index);
	xml_parser_free($p);
	if($vals) {
		$this->vals = $vals;
		return true;
	}
}


// Search for a value in an array:
public function exchangeRate() {
	$vals = $this->vals;
	$currKey = explode( "/", $this->currKey );
	
	$temp = &$vals;
	foreach($currKey as $key) {
		$temp =& $temp[$key];
	}
	$this->exchangeRate = $temp;
}


// Return value:
function getExchangeRate() {
	$exchangeRate = $this->exchangeRate;
	$exchangeRate = self::sanitize($exchangeRate);
	return $exchangeRate;
}


// Sanitize data obtained from outside:
function sanitize($val) {
	$val = trim($val);
	$val = stripslashes($val);
	$val = strip_tags($val);
	return $val;
}
}
