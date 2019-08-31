<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

namespace ikdev\ikpanel\app\Providers;


use Illuminate\Support\ServiceProvider;
use Storage;

class DropboxServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        // Disabled
        /*Storage::extends('dropbox', function($app, $config) {
            $client = new DropboxClient(
                $config['authorization_token']
            );
            
            return new Filesystem(new DropboxAdapter($client));
        });*/
    }
    
}
