<?php
chdir(dirname(dirname(__FILE__)));
require_once 'lib/autoload.php';
require_once 'lib/Webshop.php';

use Webshop\Webshop;

Webshop::settings([
	
	'db' => [
		
		'hostname' => 'localhost',
		'username' => 'root',
		'password' => 'x1joXiE5nhU3DlM',
		'database' => 'webshop',
	],
]);

$webshop 	= new Webshop('ListCategories');
$categories = $webshop->categories();

foreach ($categories as $category) {
	
	echo "<strong>{$category->title}</strong>";
	echo '<br />';
}