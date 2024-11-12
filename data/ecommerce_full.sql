-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 12, 2024 at 03:06 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_full`
--

-- --------------------------------------------------------

--
-- Table structure for table `ecom_categories`
--

DROP TABLE IF EXISTS `ecom_categories`;
CREATE TABLE IF NOT EXISTS `ecom_categories` (
  `cats_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cats_name` varchar(128) NOT NULL,
  `cats_desc` varchar(512) NOT NULL,
  `cats_img` varchar(128) NOT NULL,
  PRIMARY KEY (`cats_id`),
  UNIQUE KEY `cats_name_UNIQUE` (`cats_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_categories`
--

INSERT INTO `ecom_categories` (`cats_id`, `cats_name`, `cats_desc`, `cats_img`) VALUES
(1, 'Living', 'Items to brighten up your living room', 'images/category/Living.jpg'),
(2, 'Outdoor', 'Everything you need from Garden Furniture to BBQs', 'images/category/Outdoor.jpg'),
(3, 'Kitchen', 'The best in Kitchenware, whatever your appetite', 'images/category/Kitchen.jpg'),
(4, 'Bedroom', 'Mattresses, Night Tables, Curtains and everything else to guarantee a good night&#039;s sleep', 'images/category/Bedroom.jpg'),
(5, 'Bathroom', 'Stylish Tubs and Showers for all tastes', 'images/category/Bathroom.jpg'),
(6, 'Garden', 'From Patio Furniture to Swing Sets. All your garden needs, here!', 'images/category/Garden.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_products`
--

DROP TABLE IF EXISTS `ecom_products`;
CREATE TABLE IF NOT EXISTS `ecom_products` (
  `prod_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(128) NOT NULL,
  `prod_desc` varchar(512) DEFAULT NULL,
  `prod_price` decimal(8,2) NOT NULL,
  `prod_img` varchar(128) NOT NULL,
  `prod_amount` smallint NOT NULL,
  PRIMARY KEY (`prod_id`),
  UNIQUE KEY `prod_name_UNIQUE` (`prod_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_products`
--

INSERT INTO `ecom_products` (`prod_id`, `prod_name`, `prod_desc`, `prod_price`, `prod_img`, `prod_amount`) VALUES
(1, 'Double Chair', 'A comfortable chair for couples to share', 499.00, 'images/products/product1.jpg', 42),
(2, 'Dining Table', 'A collapsable kitchen table', 399.00, 'images/products/product5.jpg', 5),
(3, 'Mattress', 'Memory Foam guarantees a great sleep', 299.00, 'images/products/product3.jpg', 38),
(4, 'Bed - King Size', 'A bed large enough for a king', 899.00, 'images/products/product4.jpg', 48),
(5, 'Couple Sofa', 'A large fold-out sofa', 699.00, 'images/products/product2.jpg', 42),
(6, 'Deluxe Recliner', 'Stretch out for the evening ', 349.00, 'images/products/product6.jpg', 18),
(7, 'Recliner Set', 'Twin reclining chairs for those sunny days', 399.00, 'images/products/product7.jpg', 22),
(8, 'Chair', 'Comfortable chair', 199.00, 'images/products/product8.jpg', 36);

-- --------------------------------------------------------

--
-- Table structure for table `ecom_products_has_ecom_categories`
--

DROP TABLE IF EXISTS `ecom_products_has_ecom_categories`;
CREATE TABLE IF NOT EXISTS `ecom_products_has_ecom_categories` (
  `ecom_prod_id` int UNSIGNED NOT NULL,
  `ecom_cats_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`ecom_prod_id`,`ecom_cats_id`),
  KEY `fk_ecom_products_has_ecom_categories_ecom_categories1_idx` (`ecom_cats_id`),
  KEY `fk_ecom_products_has_ecom_categories_ecom_products_idx` (`ecom_prod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_products_has_ecom_categories`
--

INSERT INTO `ecom_products_has_ecom_categories` (`ecom_prod_id`, `ecom_cats_id`) VALUES
(1, 1),
(5, 1),
(6, 1),
(8, 1),
(7, 2),
(2, 3),
(3, 4),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ecom_users`
--

DROP TABLE IF EXISTS `ecom_users`;
CREATE TABLE IF NOT EXISTS `ecom_users` (
  `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_username` varchar(128) NOT NULL,
  `user_password` varchar(128) NOT NULL,
  `user_fullname` varchar(128) NOT NULL,
  `user_email` varchar(128) NOT NULL,
  `user_address` varchar(512) NOT NULL,
  `user_uniqid` varchar(60) NOT NULL,
  `user_roles` varchar(64) NOT NULL DEFAULT '["ROLE_USER"]',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_username_UNIQUE` (`user_username`),
  UNIQUE KEY `user_uniqid_UNIQUE` (`user_uniqid`),
  UNIQUE KEY `user_email_UNIQUE` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ecom_users`
--

INSERT INTO `ecom_users` (`user_id`, `user_username`, `user_password`, `user_fullname`, `user_email`, `user_address`, `user_uniqid`, `user_roles`) VALUES
(1, 'leerlandais', '$2y$10$Ny9WrapGR8lQE9MoFkZ2p.2a/eZuwJIGs5hhxWvvnhn.JokmYNXgO', 'Lee Brennan', 'lee@leerlandais.com', 'Rue du Bailli 4, 1000, Bruxelles', 'user_672bb3d59fac41.24116290', '[\"ROLE_SUPER\",\"ROLE_ADMIN\", \"ROLE_USER\"]'),
(4, 'test', '$2y$10$sGSEEhZNcqjr22zjsVe/yOBOMTRaTzrPePBANNun32V75rYbwbcCa', 'test', 'test@test.test', 'test test 4 test 1000 test', 'user_673365317caf81.64644623', '[\"ROLE_USER\"]'),
(5, 'admin', '$2y$10$xnUvraix08fgAHqWFW9cgeoGL1s3NbFs7tFv8eD4Mcm2xg0VBIr.m', 'A Fake Admin', 'admin@admin.fk', 'Somewhere, Someplace, Sometown', 'user_67336572936194.05677995', '[\"ROLE_ADMIN\", \"ROLE_USER\"]');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ecom_products_has_ecom_categories`
--
ALTER TABLE `ecom_products_has_ecom_categories`
  ADD CONSTRAINT `fk_ecom_products_has_ecom_categories_ecom_categories1` FOREIGN KEY (`ecom_cats_id`) REFERENCES `ecom_categories` (`cats_id`),
  ADD CONSTRAINT `fk_ecom_products_has_ecom_categories_ecom_products` FOREIGN KEY (`ecom_prod_id`) REFERENCES `ecom_products` (`prod_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
