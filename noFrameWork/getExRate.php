<?php
include_once 'autoload.php';
error_reporting(0);
ini_set('display_errors', 0);
//--------------------------------------------------------------------//
$str = $_POST['dataString'];
echo( $str );
//--------------------------------------------------------------------//
// Source files uri list:
/*
http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml
https://www.cbr-xml-daily.ru/daily_json.js
*/
$url[] = ["38/attributes/RATE", "http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml"];
$url[] = ["38/attributes/RATE", "http://localhost/MaxiBooking/sourceEUR/eurofxref-daily.xml"];
$url[] = ["38/attributes/RATE", "http://localhost/MaxiBooking/sourceEUR/eurofxref-daily1.xml"];	// doesn't exists
$url[] = ["Valute/EUR/Value", "https://www.cbr-xml-daily.ru/daily_json.js"];
$url[] = ["Valute/EUR/Value", "http://localhost/MaxiBooking/sourceEUR/daily_json.js"];
$url[] = ["Valute/EUR/Value", "http://localhost/MaxiBooking/sourceEUR/daily_json1.js"];			// doesn't exists
// shuffle($url);

// Create GetExchangeRate class instance and receive data from url:
 $rate = new GetExchangeRate( $url ); 
 $exchangeRate = $rate->exchangeRate();
 echo ( $rate->getExchangeRate() );
//--------------------------------------------------------------------//
