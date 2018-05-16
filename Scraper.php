<?php
namespace Nobin;

use GuzzleHttp\Client;
use Sunra\PhpSimple\HtmlDomParser;

require_once __DIR__ . '/vendor/autoload.php';

class Scraper 
{
	public static function client(){
		return new Client();
    }
    
	public static function html($html){
		return HtmlDomParser::str_get_html( $html );
	}
}

