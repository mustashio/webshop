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

class Cart {

	protected $storage;

	public function __construct(StorageInterface $storage) {
		$this->storage = $storage;
	}
	
	public function storage() {
		return $this->storage;
	}
	
	public function checkout() {
		
		$order 	  = new \Webshop\Model\Order;
		$products = $storage->items();
		foreach ($products as $productId => $quantity) {
			
			$product = new \Webshop\Model\Product($productId);
			$order->addProduct($product, $quantity);
		}
		
		$order->save();
		$storage->clear();
		
		return $order;
	}
}