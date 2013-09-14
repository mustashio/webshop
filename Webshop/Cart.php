<?php
namespace Webshop;

class Cart {

	public $cartId;

	public function __construct($cartId) {
		
		$this->cartId = $cartId;
		
		if (!isset($_SESSION[$this->cartId])) {
			$this->clear();
		}
	}
	
	public function add($productId, $quantity) {
		
		if (isset($_SESSION[$this->cartId][$productId])) {
			
			$_SESSION[$this->cartId][$productId] += $quantity;
			
		} else {
			
			$_SESSION[$this->cartId][$productId] = $quantity;
		}
		
		if ($_SESSION[$this->cartId][$productId] <= 0) {
			$this->remove($productId);
		}
	}
	
	public function remove($productId) {
		
		if (isset($_SESSION[$this->cartId][$productId])) {
			unset($_SESSION[$this->cartId][$productId]);
		}
	}
	
	public function clear() {
		$_SESSION[$this->cartId] = array();
	}
	
	public function checkout() {
		
		$order = new \Webshop\Model\Order;
		foreach ($_SESSION[$this->cartId] as $productId => $quantity) {
			
			$product = new \Webshop\Model\Product($productId);
			$order->addProduct($product, $quantity);
		}
		
		$order->save();
		$this->clear();
		
		return $order->ordernumber;
	}
}