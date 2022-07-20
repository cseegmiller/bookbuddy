-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2021 at 03:11 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `studentTable` (
  `classCode` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `studentID` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (studentID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `teacherTable` (
  `classCode` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (classCode)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `gradebookTable` (
  `studentID` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `task` varchar(255),
  `dateSubmit` DATETIME,
  `grade` int,
  PRIMARY KEY (studentID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `readingTable` (
  `studentID` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `dateSubmit` DATETIME,
  `startPage` int,
  `endPage` int,
  `totalPage` int,
  `minutes` int,
  PRIMARY KEY (studentID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;