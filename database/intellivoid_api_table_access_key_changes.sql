
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
