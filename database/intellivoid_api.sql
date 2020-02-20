-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2020 at 04:15 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intellivoid_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_key_changes`
--

CREATE TABLE `access_key_changes` (
  `id` int(255) NOT NULL COMMENT 'Internal unique database ID for this record',
  `access_record_id` int(255) DEFAULT NULL COMMENT 'The ID of the access record that this change is associated with',
  `old_access_key` varchar(255) DEFAULT NULL COMMENT 'The old access key that was used before the change',
  `new_access_key` varchar(255) DEFAULT NULL COMMENT 'The new access key that was generated',
  `timestamp` int(255) DEFAULT NULL COMMENT 'The Unix Timestamp for when this changed occurred'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Events for when a access key was changed';

-- --------------------------------------------------------

--
-- Table structure for table `access_records`
--

CREATE TABLE `access_records` (
  `id` int(255) NOT NULL COMMENT 'Internal unique database ID for this access record',
  `access_key` varchar(255) DEFAULT NULL COMMENT 'The unique access key used for API authentication',
  `last_changed_access_key` int(255) DEFAULT NULL COMMENT 'The Unix Timestamp of when this access key was last changed',
  `application_id` int(255) DEFAULT NULL COMMENT 'The Application ID that this Access Record is associated with',
  `subscription_id` int(255) DEFAULT NULL COMMENT 'Optional (0=None) Subscription ID that this Access Record is associated with will regulate by',
  `status` int(255) DEFAULT NULL COMMENT 'The status of the Access Record',
  `variables` blob DEFAULT NULL COMMENT 'ZiProto encoded data which indicates variables set by the application',
  `rate_limit_type` varchar(255) DEFAULT NULL COMMENT 'The rate limit type that has been configured for this access record',
  `rate_limit_configuration` blob DEFAULT NULL COMMENT 'ZiProto encoded data which contains the configuration data for the rate limit',
  `last_activity` int(255) DEFAULT NULL COMMENT 'Unix Timestamp for when this Access Record was last used by the client',
  `created` int(255) DEFAULT NULL COMMENT 'The Unix Timestamp for when this access record was created'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Access records for users that can use the API';

-- --------------------------------------------------------

--
-- Table structure for table `exception_records`
--

CREATE TABLE `exception_records` (
  `id` int(255) NOT NULL COMMENT 'The internal unique database ID for this exception record',
  `request_record_id` int(255) DEFAULT NULL COMMENT 'The request record ID that raised this unexpected exception',
  `application_id` int(255) DEFAULT NULL COMMENT 'The Application ID responsible for handling the request, 0 = None',
  `access_record_id` int(255) DEFAULT NULL COMMENT 'The ID of the access record that created the request, 0 = None',
  `message` varchar(2526) DEFAULT NULL COMMENT 'The message that the exception has returned',
  `file` varchar(1526) DEFAULT NULL COMMENT 'The location of the affected file',
  `line` int(255) DEFAULT NULL COMMENT 'The line where the exception was thrown',
  `code` int(255) DEFAULT NULL COMMENT 'The exception code returned by the exception',
  `trace` blob DEFAULT NULL COMMENT 'Exception trace which is encoded in ZiProto',
  `timestamp` int(255) DEFAULT NULL COMMENT 'The Unix Timestamp for when this record was created'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Uncaught exceptions that are logged in this table';

-- --------------------------------------------------------

--
-- Table structure for table `request_records`
--

CREATE TABLE `request_records` (
  `id` int(255) NOT NULL COMMENT 'The unique internal database ID for this record',
  `reference_id` varchar(255) DEFAULT NULL COMMENT 'The public reference ID for this request record',
  `access_record_id` int(255) DEFAULT NULL COMMENT 'The ID of the access record that created this request (0 = None)',
  `application_id` int(255) DEFAULT NULL COMMENT 'The ID of the application that this request is for (0 = None)',
  `request_method` varchar(255) DEFAULT NULL COMMENT 'The HTTP Request method used to make this request',
  `version` varchar(255) DEFAULT NULL COMMENT 'The version that the request was based on',
  `path` varchar(255) DEFAULT NULL COMMENT 'The request path that was given',
  `request_payload` blob DEFAULT NULL COMMENT 'Zi Proto encoded data of the GET/POST payload sent from the client',
  `ip_address` varchar(255) DEFAULT NULL COMMENT 'The IP Address that was used to create the request',
  `user_agent` varchar(624) DEFAULT NULL COMMENT 'Base64 Encoded data of the User Agent that was used (512 Characters max)',
  `response_code` int(255) DEFAULT NULL COMMENT 'The response code that was used after the request has been completed',
  `response_content_type` varchar(255) DEFAULT NULL COMMENT 'The content type given in the response',
  `response_length` int(255) DEFAULT NULL COMMENT 'The length of the response in bytes',
  `response_time` float DEFAULT NULL COMMENT 'The time it took to process the request',
  `day` int(255) DEFAULT NULL COMMENT 'The date of the day that this response took place in',
  `month` int(255) DEFAULT NULL COMMENT 'The date of the month that this request took place in',
  `year` int(255) DEFAULT NULL COMMENT 'The date of the year that this response took place in',
  `timestamp` int(255) DEFAULT NULL COMMENT 'The Unix Timestamp of when this request took place in'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table of API Requests records';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_key_changes`
--
ALTER TABLE `access_key_changes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `access_key_changes_id_uindex` (`id`);

--
-- Indexes for table `access_records`
--
ALTER TABLE `access_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `access_records_id_uindex` (`id`);

--
-- Indexes for table `exception_records`
--
ALTER TABLE `exception_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exception_records_id_uindex` (`id`);

--
-- Indexes for table `request_records`
--
ALTER TABLE `request_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `request_records_id_uindex` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_key_changes`
--
ALTER TABLE `access_key_changes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Internal unique database ID for this record';

--
-- AUTO_INCREMENT for table `access_records`
--
ALTER TABLE `access_records`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'Internal unique database ID for this access record';

--
-- AUTO_INCREMENT for table `exception_records`
--
ALTER TABLE `exception_records`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'The internal unique database ID for this exception record';

--
-- AUTO_INCREMENT for table `request_records`
--
ALTER TABLE `request_records`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT COMMENT 'The unique internal database ID for this record';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
