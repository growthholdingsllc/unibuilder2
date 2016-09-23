<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Authorize.net Account Info
$config['api_login_id'] = '4yVzS9m6x';
$config['api_transaction_key'] = '83upLWy898T63Z4W';

// ARB URL
$config['arb_api_url'] = 'https://apitest.authorize.net/xml/v1/request.api'; // TEST URL
//$config['arb_api_url'] = 'https://api.authorize.net/xml/v1/request.api'; // PRODUCTION URL


// AIM URL
$config['api_url'] = 'https://test.authorize.net/gateway/transact.dll';// TEST URL 
//$config['api_url'] = 'https://secure.authorize.net/gateway/transact.dll'; // PRODUCTION URL 

/* EOF */