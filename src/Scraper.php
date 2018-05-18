<?php
namespace Nobin;

use GuzzleHttp\Client;
use Sunra\PhpSimple\HtmlDomParser;

class Scraper
{
	public $response;
	public $headers;
	public $client;

	const DOMAIN = false;

	public function client(){

		if ( $this->client ) {
			return;
		}

		$this->headers = [
			'User-Agent' => 'Mozilla/5.0 (Windows NT 5.2; rv:2.0.1) Gecko/20100101 Firefox/4.0.1',
		];

		$this->client = new Client([
			'base_uri' => static::DOMAIN,
			'headers'  => $this->headers,
		]);

		return $this->client;
	}

	public function get($url){
		$this->response = $this->client()->get($url);

		return $this;
	}

	function getBody(){
		return $this->response->getBody();
	}

	function isHtml($html){
		// return instamce_o;
	}

	public function html($html = ''){
		if ( ! $html) {
			$html = $this->response->getBody();
		}

		return HtmlDomParser::str_get_html( $html );
	}

	function url($url){
		return rtrim(static::DOMAIN , '/' ) . '/' . ltrim($url);
	}
}

