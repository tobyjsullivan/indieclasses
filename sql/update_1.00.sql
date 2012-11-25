-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 25, 2012 at 12:54 AM
-- Server version: 5.5.28
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `indieclasses`
--

-- --------------------------------------------------------

--
-- Table structure for table `applied_updates`
--

CREATE TABLE IF NOT EXISTS `applied_updates` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `version` varchar(8) NOT NULL,
  `applied` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `version` (`version`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `applied_updates`
--

INSERT INTO `applied_updates` (`id`, `version`, `applied`) VALUES
(000001, '1.00', '2012-11-25 00:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `url` varchar(8) NOT NULL,
  `title` varchar(100) NOT NULL,
  `teacher_id` int(6) unsigned zerofill NOT NULL,
  `space_id` int(6) unsigned zerofill NOT NULL,
  `price` int(3) NOT NULL,
  `min_attendees` int(3) NOT NULL,
  `max_attendees` int(3) NOT NULL,
  `deadline` datetime NOT NULL,
  `start_date` datetime NOT NULL,
  `duration` int(3) NOT NULL,
  `repetitions` int(2) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE IF NOT EXISTS `registrations` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `class_id` int(6) unsigned zerofill NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `stripe_customer_id` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `stripe_charge_id` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `spaces`
--

CREATE TABLE IF NOT EXISTS `spaces` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `address` varchar(100) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `city` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `website` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
