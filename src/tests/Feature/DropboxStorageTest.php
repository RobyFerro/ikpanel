<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\tests\Feature;

use Tests\TestCase;
use Spatie\Dropbox\Client;
use GuzzleHttp\Client as GuzzleClient;

class DropboxStorageTest extends TestCase {
	
	/**
	 * Test Dropbox connection
	 * @throws \Exception
	 */
	public function testDropboxConnection() {
		
		$guzzleClient = new GuzzleClient(['verify' => false]);
		$client = new Client(env('DROPBOX_ACCESS_TOKEN'), $guzzleClient);
		
		try {
			$list = $client->getAccountInfo();
		} catch (\Exception $e) {
			throw $e;
		} // try
		
		$this->assertNotEmpty($list);
	}
	
}
