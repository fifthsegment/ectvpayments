<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
|	http://example.com/
|
| If this is not set then CodeIgniter will guess the protocol, domain and
| path to your installation.
|
*/
$config['paypal_email'] = 'rechos16@gmail.com';
$config['paypal_sandbox'] = true;
$config['paypal_url'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
$config['paypal_ackurl'] = 'http://ectvpayments.herokuapp.com/index.php/manager/paypal_notify';
$config['paypal_returnurl'] = 'http://ectvpayments.herokuapp.com/index.php/manager/paypal_return';
$config['paypal_currencycode'] = 'USD';