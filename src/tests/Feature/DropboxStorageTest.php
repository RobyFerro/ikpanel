<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 01/03/2019
 * Time: 16:28
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
