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
use       \Webshop\Model;

class Webshop {
    
	/**
	 * @var string
	 */
    protected $name            = 'Untitled';
    
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
    public static $connection = null;
    
	/**
	 * Construct a webshop
	 *
	 * @param string $name
	 * @param array  $settings
	 */
    public function __construct($name = 'Untitled', $settings) {
        
        $this->name     = $name;
		$this->settings = array_replace_recursive($settings, $this->settings);
    }
	
	public function connection() {
		
		if (static::$db === null) {
			static::$db = new \PDO('mysql:host=' . self::$settings['db']['hostname'] . ';dbname=' . self::$settings['db']['database'], self::$settings['db']['username'], self::$settings['db']['password']);
		}
		
		return static::$db;
	}
	
	public function name() {
		return $this->name;
	}
    
    public function categories() {
        return \Webshop\Model\Category::getAll();
    }
	
	public function products() {
		return \Webshop\Model\Product::getAll();
	}
}