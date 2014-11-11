<?php
/**
 * Webshop (https://github.com/ibrahimabdullah/webshop)
 *
 * @link 	  https://github.com/ibrahimabdullah/webshop for the repo
 * @copyright Copyright (c) 2014 Ibrahim Abdullah
 * @license   MIT License (http://opensource.org/licenses/MIT)
 * @author    Ibrahim Abdullah <ibrahim.abdullah@outlook.com>
 */
namespace Webshop\Model;
use       Webshop\Model\Exception as ModelException;

class Order extends Model {
	
	/**
	 * @var string
	 */
	protected static $table   = 'orders';
	
	/**
	 * @var array
	 */
	protected $products = [];
	
	/**
	 * @return void
	 * @throws ModelException, \PDO\Exception
	 */
	public function save() {
		
		if (count($this->products) > 0) {
		
			$connection	= Webshop::connection();
			$statement  = $connection->prepare('SELECT MAX(ordernumber) AS ordernumber FROM orders');
			$statement->execute();
			
			$result 				   = $statement->fetch(\PDO::FETCH_ASSOC);
			$this->data['ordernumber'] = (intval($result['ordernumber']) + 1);
		
			parent::save();

			$order_id = $this->id;

			array_map(function($order_product) use ($order_id) {
				
				$order_product->order_id = $order_id;
				$order_product->save();
				
			}, $this->order_products);
			
		} else {
			
			throw new ModelException('CANNOT SAVE ORDER, ORDER HAS NO PRODUCTS');
		}
	}
	
	/**
	 * @return void
	 */
	public function add($product, $quantity) {
		
		$data		   = array(
		
			'product_id'  => $product->id,
			'title'		  => $product->title,
			'description' => $product->description,
			'price'		  => $product->price,
			'tax'		  => $product->tax,
			'quantity'    => $quantity
		);
		
		$this->order_products[] = new Order\Product(null, $data);
	}
}