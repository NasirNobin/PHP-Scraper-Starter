<?php

/* someday i will write automated testing -_- */

require dirname(__DIR__) . '/vendor/autoload.php';

use Nobin\Scraper;

/**
 *
 */
class TestClient extends Scraper {

	function __construct() {

		$this->visit_site();
	}

	function visit_site(){
		$browser = $this->headless()->visit('http://example.com');
		$browser->getDriver()->takeScreenshot('tests/test.png');
	}
}

new TestClient();