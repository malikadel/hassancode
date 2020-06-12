<?php 
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
require_once('vendor/autoload.php');
$stripe_public_key = 'pk_test_3em0UdmPQCFgObmPCOfKUTdm00vSFa4pIP';
$stripe_secret_key = 'sk_test_LuXOLNnsQh1s8RKifEvSuD8X00VL77P49Y';
$ajaxpath = 'http://localhost/hassan/ajax/';
$ajaxpath = 'http://pnwnastt.mltgroup.com/hassan/ajax/';

\Stripe\Stripe::setApiKey($stripe_secret_key);
