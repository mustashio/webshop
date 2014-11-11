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

interface StorageInterface {
	
	public function items();
	public function get($productId = null);
	public function add($productId, $quantity);
	public function remove($productId);
	public function clear();
}