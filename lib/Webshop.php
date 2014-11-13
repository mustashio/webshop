<?php
/**
 * Webshop (https://github.com/ibrahimabdullah/webshop)
 *
 * @link 	  https://github.com/ibrahimabdullah/webshop for the repo
 * @copyright Copyright (c) 2014 Ibrahim Abdullah
 * @license   MIT License (http://opensource.org/licenses/MIT)
 * @author    Ibrahim Abdullah <ibrahim.abdullah@outlook.com>
 */
namespace Webshop;
use       Webshop\Model;

class Webshop {
    
	/**
	 * @var string
	 */
    protected $name = 'Untitled';
	
	/**
	 * @var Model\Category[]
	 */
	protected $categories = [];
	
	/**
	 * @var Model\Product[]
	 */
	protected $products = [];
	
	/**
	 * Cart object
	 * 
	 * @var Cart
	 */
	protected $cart = null;
    
	/**
	 * @var array
	 */
	protected static $settings = array(
        
		'db' => array(
		
	        'hostname' => '',
	        'username' => '',
	        'password' => '',
	        'database' => '',
		),
    );
	
	/**
	 * @var \PDO
	 */
    protected static $connection = null;
    
	/**
	 * Construct a webshop
	 *
	 * @param string $name
	 * @param array  $settings
	 */
    public function __construct($name = 'Untitled') {
        $this->name = $name;
    }
	
	public static function settings($settings) {
		static::$settings = array_replace_recursive(static::$settings, $settings);
	}
	
	/**
	 * connect with database
	 *
	 * @return \PDO
	 */
	public static function connection() {
		
		if (static::$connection === null) {
			
			$db = static::$settings['db'];
			static::$connection = new \PDO('mysql:host=' . $db['hostname'] . ';dbname=' . $db['database'], $db['username'], $db['password']);
		}
		
		return static::$connection;
	}
	
	/**
	 * Name of the webshop
	 *
	 * @return string
	 */
	public function name() {
		return $this->name;
	}
    
	/** 
	 * @return Model\Category[]
	 */
    public function categories() {
		
		if (empty($this->categories)) {
			$this->categories = Model\Category::getAll();
		}
		
		return $this->categories;
    }
	
	/**
	 * @return Model\Product[]
	 */
	public function products() {
		
		if (null === $this->products) {
			$this->products = Model\Product::getAll();
		}
		
		return $this->products;
	}
}