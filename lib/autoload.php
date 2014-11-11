<?php
/**
 * Webshop (https://github.com/ibrahimabdullah/webshop)
 *
 * @link 	  https://github.com/ibrahimabdullah/webshop for the repo
 * @copyright Copyright (c) 2014 Ibrahim Abdullah
 * @license   MIT License (http://opensource.org/licenses/MIT)
 * @author    Ibrahim Abdullah <ibrahim.abdullah@outlook.com>
 */
function __autoload($class) {

	$classes  = explode('\\', $class);
	require_once implode('/', $classes) . '.php';
}