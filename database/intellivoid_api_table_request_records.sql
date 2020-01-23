
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
