<?php
namespace Nobin;

use GuzzleHttp\Client;
use duncan3dc\Laravel\Dusk;
use Sunra\PhpSimple\HtmlDomParser;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class Scraper
{
	public $response;
	public $headers;
	public $client;
	public $browser;
	public $driver;

	const DOMAIN = false;

	public function client(){

		if ( $this->client ) {
			return $this->client;
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

	public function browser(){

		if ( $this->browser ) {
			return $this->browser;
		}

		$this->browser = new Dusk($this->driver());

		return $this->browser;
	}

	function headless(){
		$this->driver = new ChromeDriver(9515);
		return $this;
	}

	public function driver(){

		if ( $this->driver ) {
			return $this->driver;
		}

		$this->driver = new ChromeDriver(9515, ['--disable-gpu']);

		return $this->driver;
	}

	public function get($url){
		$this->response = $this->client()->get($url);

		return $this;
	}

	public function visit($url = ''){
		return $this->browser()->visit($url);
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

