
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
