-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2017 at 06:55 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `uthando-cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

DROP TABLE IF EXISTS `widget`;
CREATE TABLE `widget` (
  `widgetId` int(10) UNSIGNED NOT NULL,
  `widgetGroupId` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `widget` varchar(255) NOT NULL,
  `sortOrder` int(2) UNSIGNED NOT NULL DEFAULT '0',
  `showTitle` int(1) UNSIGNED NOT NULL DEFAULT '0',
  `params` text,
  `html` text,
  `enabled` int(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `widgetGroup`
--

DROP TABLE IF EXISTS `widgetGroup`;
CREATE TABLE `widgetGroup` (
  `widgetGroupId` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `widget`
--
ALTER TABLE `widget`
  ADD PRIMARY KEY (`widgetId`);

--
-- Indexes for table `widgetGroup`
--
ALTER TABLE `widgetGroup`
  ADD PRIMARY KEY (`widgetGroupId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `widget`
--
ALTER TABLE `widget`
  MODIFY `widgetId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `widgetGroup`
--
ALTER TABLE `widgetGroup`
  MODIFY `widgetGroupId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;
