<?php
/**
 * Created by Interactive Knowledge Development.
 * User: roberto.ferro
 * Date: 28/02/2019
 * Time: 19:07
 */

namespace ikdev\ikpanel;


use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;

class DropboxServiceProvider extends ServiceProvider {
	
	public function boot() {
		Storage::extends('dropbox', function($app, $config) {
			$client = new DropboxClient(
				$config['authorization_token']
			);
			
			return new Filesystem(new DropboxAdapter($client));
		});
	}
	
}
