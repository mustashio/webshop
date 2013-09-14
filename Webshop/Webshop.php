<?php
namespace Webshop;
use       \Webshop\Model;

class Webshop {
    
    // webshop name
    public $name            = 'Untitled';
    
	// db settings
	public static $settings = array(
        
		'db' => array(
		
	        'hostname' => '****************',
	        'username' => '****************',
	        'password' => '****************',
	        'database' => '****************',
		),
    );
	
	// db connection
    public static $db       = null;
    
    public function __construct($name = 'Untitled') {
        
        $this->name = $name;
		
		if (self::$db === null) {
			self::$db = new \PDO('mysql:host=' . self::$settings['db']['hostname'] . ';dbname=' . self::$settings['db']['database'], self::$settings['db']['username'], self::$settings['db']['password']);
		}
    }
    
    public function getCategories() {
        return \Webshop\Model\Category::getAll();
    }
	
	public function getProducts() {
		return \Webshop\Model\Product::getAll();
	}
}