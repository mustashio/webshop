<?php
session_start();
error_reporting(E_ALL);

use \Webshop\Webshop as Webshop;
use \Webshop\Cart as Cart;

$webshop = new Webshop;
$cart    = new Cart('Webshop_Cart');

function __autoload($class) {
 
    // convert namespace to full file path
    $class = str_replace('\\', '/', $class) . '.php';
    require_once $class;
}