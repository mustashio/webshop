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
use       Webshop\Cart;
use       Webshop\Model;

class Cart {

    /**
	 * Cart Storage
	 *
	 * @var StorageInterface
	 */
	protected $storage = null;

    /**
	 * @param StorageInterface $storage
	 */
	public function __construct(StorageInterface $storage = null) {
		
		if (null === $storage) {
			$storage = new Cart\Storage\Session('CartStorageSession');
		}
		
		$this->storage = $storage;
	}
	
	/**
	 * @return StorageInterface
	 */
	public function storage() {
		return $this->storage;
	}
	
	/**
	 * @return Model\Order
	 */
	public function checkout() {
		
		$order 	  = new Model\Order;
		$products = $storage->items();
		foreach ($products as $productId => $quantity) {
			
			$product = new Model\Product($productId);
			$order->addProduct($product, $quantity);
		}
		
		$order->save();
		$storage->clear();
		
		return $order;
	}
}