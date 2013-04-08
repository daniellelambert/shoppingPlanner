-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 28, 2013 at 06:01 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
DROP DATABASE IF EXISTS mealplanner;
CREATE DATABASE IF NOT EXISTS mealplanner;
GRANT ALL PRIVILEGES ON mealplanner.* TO 'Mealuser'@'localhost' identified by 'user';
use mealplanner;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mealplanner`
--

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE IF NOT EXISTS `dish` (
  `recipe_id` int(10) unsigned NOT NULL,
  `meal_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`recipe_id`,`meal_id`),
  KEY `meal_id` (`meal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY(`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE IF NOT EXISTS `food` (
  `food_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `food_name` varchar(75) NOT NULL,
  `store_loc` varchar(30) NOT NULL,
  PRIMARY KEY (`food_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE IF NOT EXISTS `ingredient` (
  `food_id` int(10) unsigned NOT NULL,
  `recipe_id` int(10) unsigned NOT NULL,
  `amount` int(11) NOT NULL,
  `units` varchar(20) NOT NULL,
  PRIMARY KEY (`food_id`,`recipe_id`),
  KEY `recipe_id` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE IF NOT EXISTS `meal` (
  `meal_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cook_date` date NOT NULL,
  PRIMARY KEY (`meal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `meal_connector`
--

CREATE TABLE IF NOT EXISTS `meal_connector` (
  `meal_id` int(10) unsigned NOT NULL,
  `meal_plan_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`meal_id`,`meal_plan_id`),
  KEY `meal_plan_id` (`meal_plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meal_plan`
--

CREATE TABLE IF NOT EXISTS `meal_plan` (
  `meal_plan_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `week_start` date NOT NULL,
  `pdf_loc` varchar(50) NOT NULL,
  PRIMARY KEY (`meal_plan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE IF NOT EXISTS `recipe` (
  `recipe_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `recipe_name` VARCHAR(50) NOT NULL,
  `description` blob NOT NULL,
  `instructions` blob NOT NULL,
  `cook_time` time NOT NULL,
  `rating` int(11) NOT NULL,
  `comments` blob,
  `last_cook_week` date DEFAULT NULL,
  `date_added` date NOT NULL,
  `side_dishes` int(11) NOT NULL,
  `pic_location` varchar(50) NOT NULL,
  PRIMARY KEY (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dish`
--
ALTER TABLE `dish`
  ADD CONSTRAINT `dish_ibfk_2` FOREIGN KEY (`meal_id`) REFERENCES `meal` (`meal_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dish_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `ingredient_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`recipe_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingredient_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food` (`food_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meal_connector`
--
ALTER TABLE `meal_connector`
  ADD CONSTRAINT `meal_connector_ibfk_2` FOREIGN KEY (`meal_plan_id`) REFERENCES `meal_plan` (`meal_plan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meal_connector_ibfk_1` FOREIGN KEY (`meal_id`) REFERENCES `meal` (`meal_id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
INSERT INTO `users` (email, password) VALUES ('test@umw.edu', 'test');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
