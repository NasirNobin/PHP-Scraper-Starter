<?php
namespace Nobin;

use Sunra\PhpSimple\HtmlDomParser;

require __DIR__ . '/vendor/autoload.php';

class Scraper 
{
	public static function html($html){
		return HtmlDomParser::str_get_html( $html );
	}
}

