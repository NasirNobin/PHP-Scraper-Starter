<?php

/* someday i will write automated testing -_- */

require dirname(__DIR__) . '/vendor/autoload.php';

use Nobin\Scraper;
use Nobin\ChromeDriver;
use duncan3dc\Laravel\Dusk;

/**
 *
 */
class TestClient extends Scraper {

	function __construct() {
		// $this->visit_site();
		// $this->test_cookie();
		$this->test_proxy();
	}

	function test_proxy(){
		//disable-gpu / '--proxy-server=159.65.145.235:8080'
		$browser = new Dusk(new ChromeDriver(9515, ['--disable-gpu']));
		$driver  = $browser->getDriver();

		$browser->visit('http://janabd.com');

		$browser->pause(5000);

		$browser->click('.adsbygoogle');

		$browser->pause(100000);
	}

	function test_cookie(){

		$browser = $this->browser();
		$driver  = $browser->getDriver();

		$cookies = unserialize(file_get_contents('tests/cookie.txt'));

		print_r($cookies);

		$browser->visit('http://quotes.toscrape.com');

		$browser->pause(3000);

  		foreach ($cookies as $cookie) {
  			$driver->manage()->addCookie($cookie);
  		}

		$browser->visit('http://quotes.toscrape.com');

		$browser->pause(5000);

		return;

		$browser->type('username', 'hello')
				->type('password','world')
				->click('input[value=Login]');

		// $cookies = [];

		// foreach ( as $key => $cookie) {
		// 	$cookies[$cookie['name']] =  $cookie['value'];
		// }

  		file_put_contents('tests/cookie.txt', serialize($driver->manage()->getCookies()));

  		print_r($cookies);

		$browser->pause(100);
	}

	function visit_site(){
		$browser = $this->headless()->visit('http://example.com');
		$browser->getDriver()->takeScreenshot('tests/test.png');

		$cookies = $browser->getDriver()->manage()->getCookies();

        file_put_contents('cookie.txt', json_encode($cookies));
	}
}

new TestClient();