<?php
/**
 * Webshop (https://github.com/ibrahimabdullah/webshop)
 *
 * @link 	  https://github.com/ibrahimabdullah/webshop for the repo
 * @copyright Copyright (c) 2014 Ibrahim Abdullah
 * @license   MIT License (http://opensource.org/licenses/MIT)
 * @author    Ibrahim Abdullah <ibrahim.abdullah@outlook.com>
 */
namespace Webshop\Cart\Storage;

class Session implements StorageInterface {
	
	protected $namespace;
	
	public function __construct($namespace) {
		
		$this->namespace = $namespace;
		$this->clear();
	}
	
	public function namespace() {
		return $this->namespace;
	}
	
	public function storage() {
		return $_SESSION[$this->namespace()];
	}
	
	public function items() {
		return $this->storage();
	}
	
	public function get($productId = null) {
		return (null === $productId ? $this->storage() : $this->storage()[$productId]);
	}
	
	public function add($productId, $quantity) {
		
		if (isset($this->storage()[$productId])) {
			
			$this->storage()[$productId] += $quantity;
			
		} else {
			
			$this->storage()[$productId] = $quantity;
		}
		
		if ($this->storage()[$productId] <= 0) {
			$this->remove($productId);
		}
	}
	
	public function remove($productId) {
		
		if (isset($this->storage()[$productId])) {
			unset($this->storage()[$productId]);
		}
	}
	
	public function clear() {
		$_SESSION[$this->namespace()] = array();
	}
}