<?php
namespace Webshop\Model;

class Order extends Model {
	
	public static $table   = 'orders';
	public $order_products = array();
	
	public function save() {
		
		if (count($this->order_products) > 0) {
		
			$statement 				   = \Webshop\Webshop::$db->prepare('SELECT MAX(ordernumber) AS ordernumber FROM orders');
			$statement->execute();
			
			$result 				   = $statement->fetch(\PDO::FETCH_ASSOC);
			$this->data['ordernumber'] = (intval($result['ordernumber']) + 1);
		
			parent::save();

			$order_id				   = $this->id;

			array_map(function($order_product) use ($order_id) {
				
				$order_product->order_id = $order_id;
				$order_product->save();
				
			}, $this->order_products);
			
		} else {
			
			throw new \Webshop\Model\Exception('CANNOT SAVE ORDER, ORDER HAS NO PRODUCTS');
		}
	}
	
	public function addProduct($product, $quantity) {
		
		$data		   = array(
		
			'product_id'  => $product->id,
			'title'		  => $product->title,
			'description' => $product->description,
			'price'		  => $product->price,
			'tax'		  => $product->tax,
			'quantity'    => $quantity
		);
		
		$this->order_products[] = new \Webshop\Model\Orders_Products(null, $data);
	}
}