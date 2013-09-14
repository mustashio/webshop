-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(400) NOT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Categorie #1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et facilisis purus, sed elementum dolor. Cras enim tortor, viverra euismod nunc vitae, feugiat lacinia orci. Sed congue mauris id tempor mattis. Nunc ut mi sit amet purus vehicula hendrerit. In luctus odio ac urna eleifend molestie. Nulla elementum erat sit amet ipsum laoreet consectetur. Sed feugiat augue libero, id tincidunt eros semper nec. Praesent hendrerit ante id sapien aliquet, a porttitor ante tempus. Nam interdum feugiat nisl vitae imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam erat volutpat.', '2013-09-11 19:51:46', '2013-09-11 19:51:46'),
(2, 'Categorie #2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam velit tortor, elementum at interdum non, pretium vitae odio. Donec a mauris enim. Nam vitae faucibus lacus, a facilisis est. Nullam nec viverra eros. Maecenas commodo lacus enim, quis vehicula magna ullamcorper et. Proin convallis eros id feugiat ultricies. Pellentesque sed vestibulum odio, ac posuere nunc. Donec in scelerisque metus. Phasellus facilisis turpis quis metus placerat, eu elementum velit varius. Donec vitae lobortis est. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sem sem, aliquet in quam non, congue laoreet sapien. Nulla pretium erat quis suscipit hendrerit. Proin vehicula bibendum lacus et sollicitudin. Praesent aliquet libero ut pretium fringilla. Proin lacinia eros non nulla mollis dapibus.', '2013-09-13 11:12:40', '2013-09-13 11:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `categories_products`
--

CREATE TABLE IF NOT EXISTS `categories_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordernumber` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ordernumber`, `created_at`, `updated_at`) VALUES
(1, 1, '2013-09-14 00:55:52', '2013-09-14 00:55:52'),
(2, 2, '2013-09-14 00:57:26', '2013-09-14 00:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE IF NOT EXISTS `orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) unsigned NOT NULL,
  `product_id` int(11) NOT NULL,
  `title` varchar(400) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `quantity` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `title`, `description`, `price`, `tax`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Product #1 (update)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et facilisis purus, sed elementum dolor. Cras enim tortor, viverra euismod nunc vitae, feugiat lacinia orci. Sed congue mauris id tempor mattis. Nunc ut mi sit amet purus vehicula hendrerit. In luctus odio ac urna eleifend molestie. Nulla elementum erat sit amet ipsum laoreet consectetur. Sed feugiat augue libero, id tincidunt eros semper nec. Praesent hendrerit ante id sapien aliquet, a porttitor ante tempus. Nam interdum feugiat nisl vitae imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam erat volutpat.\r\n', 100.32, 19.00, 2, '2013-09-14 00:55:52', '2013-09-14 00:55:52'),
(2, 1, 2, 'Product #2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et facilisis purus, sed elementum dolor. Cras enim tortor, viverra euismod nunc vitae, feugiat lacinia orci. Sed congue mauris id tempor mattis. Nunc ut mi sit amet purus vehicula hendrerit. In luctus odio ac urna eleifend molestie. Nulla elementum erat sit amet ipsum laoreet consectetur. Sed feugiat augue libero, id tincidunt eros semper nec. Praesent hendrerit ante id sapien aliquet, a porttitor ante tempus. Nam interdum feugiat nisl vitae imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam erat volutpat.\r\n', 100.32, 19.00, 3, '2013-09-14 00:55:52', '2013-09-14 00:55:52'),
(3, 2, 1, 'Product #3 (update)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et facilisis purus, sed elementum dolor. Cras enim tortor, viverra euismod nunc vitae, feugiat lacinia orci. Sed congue mauris id tempor mattis. Nunc ut mi sit amet purus vehicula hendrerit. In luctus odio ac urna eleifend molestie. Nulla elementum erat sit amet ipsum laoreet consectetur. Sed feugiat augue libero, id tincidunt eros semper nec. Praesent hendrerit ante id sapien aliquet, a porttitor ante tempus. Nam interdum feugiat nisl vitae imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam erat volutpat.\r\n', 100.32, 19.00, 2, '2013-09-14 00:57:26', '2013-09-14 00:57:26'),
(4, 2, 2, 'Product #4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et facilisis purus, sed elementum dolor. Cras enim tortor, viverra euismod nunc vitae, feugiat lacinia orci. Sed congue mauris id tempor mattis. Nunc ut mi sit amet purus vehicula hendrerit. In luctus odio ac urna eleifend molestie. Nulla elementum erat sit amet ipsum laoreet consectetur. Sed feugiat augue libero, id tincidunt eros semper nec. Praesent hendrerit ante id sapien aliquet, a porttitor ante tempus. Nam interdum feugiat nisl vitae imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam erat volutpat.\r\n', 100.32, 19.00, 3, '2013-09-14 00:57:26', '2013-09-14 00:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(400) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `tax`, `created_at`, `updated_at`) VALUES
(1, 'Product #1 (update)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et facilisis purus, sed elementum dolor. Cras enim tortor, viverra euismod nunc vitae, feugiat lacinia orci. Sed congue mauris id tempor mattis. Nunc ut mi sit amet purus vehicula hendrerit. In luctus odio ac urna eleifend molestie. Nulla elementum erat sit amet ipsum laoreet consectetur. Sed feugiat augue libero, id tincidunt eros semper nec. Praesent hendrerit ante id sapien aliquet, a porttitor ante tempus. Nam interdum feugiat nisl vitae imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam erat volutpat.\r\n', 100.32, 19.00, '2013-09-13 23:18:36', '2013-09-13 23:27:49'),
(2, 'Product #2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et facilisis purus, sed elementum dolor. Cras enim tortor, viverra euismod nunc vitae, feugiat lacinia orci. Sed congue mauris id tempor mattis. Nunc ut mi sit amet purus vehicula hendrerit. In luctus odio ac urna eleifend molestie. Nulla elementum erat sit amet ipsum laoreet consectetur. Sed feugiat augue libero, id tincidunt eros semper nec. Praesent hendrerit ante id sapien aliquet, a porttitor ante tempus. Nam interdum feugiat nisl vitae imperdiet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam erat volutpat.\r\n', 100.32, 19.00, '2013-09-11 21:18:57', '2013-09-11 21:18:57');