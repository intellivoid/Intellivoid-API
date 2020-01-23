
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
