<?php
/**
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */

return [
	
	/*
    |--------------------------------------------------------------------------
    | Administration panel url
    |--------------------------------------------------------------------------
    |
    | This option is used to set the administration panel url
    |
    */
	
	"admin_panel_url" => env('IKPANEL_URL', '/'),
	
	/*
    |--------------------------------------------------------------------------
    | Main domain
    |--------------------------------------------------------------------------
    |
    | This option is used to set main domain of the application. Usually is
	| used to send link in email.
    |
    */
	
	"main_domain" => env('MAIN_DOMAIN', '/'),
	
	/*
    |--------------------------------------------------------------------------
    | Mail from address
    |--------------------------------------------------------------------------
    |
    | Set this option to set email sender address
    |
    */
	
	"mail_from" => env('MAIL_FROM_ADDRESS', 'test@domain.it'),
	
	
	/*
    |--------------------------------------------------------------------------
    | Mail max filesize
    |--------------------------------------------------------------------------
    |
    | Set this option to set email max filesize
    |
    */
	
	"mail_max_filesize" => env('MAIL_MAX_FILESIZE', '25M'),
	
	
	/*
    |--------------------------------------------------------------------------
    | Quick search options
    |--------------------------------------------------------------------------
    |
    | This set of options allow you to customisize the quick search section
    |
    */
	
	"quick_search" => [
		// Cache time
		'cache_limit' => env('QUICK_SEARCH_CACHE_LIMIT', 0)
	],
	"broadcasting" => env('IKPANEL_BROADCASTING', false)
];
