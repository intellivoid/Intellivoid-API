
--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_key_changes`
--
ALTER TABLE `access_key_changes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `access_key_changes_id_uindex` (`id`),
  ADD KEY `access_key_changes_access_records_id_fk` (`access_record_id`);

--
-- Indexes for table `access_records`
--
ALTER TABLE `access_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `access_records_id_uindex` (`id`),
  ADD KEY `access_records_applications_id_fk` (`application_id`),
  ADD KEY `access_records_subscriptions_id_fk` (`subscription_id`);

--
-- Indexes for table `exception_records`
--
ALTER TABLE `exception_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exception_records_id_uindex` (`id`),
  ADD KEY `exception_records_access_records_id_fk` (`access_record_id`),
  ADD KEY `exception_records_applications_id_fk` (`application_id`),
  ADD KEY `exception_records_request_records_id_fk` (`request_record_id`);

--
-- Indexes for table `request_records`
--
ALTER TABLE `request_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `request_records_id_uindex` (`id`),
  ADD KEY `request_records_access_records_id_fk` (`access_record_id`),
  ADD KEY `request_records_applications_id_fk` (`application_id`);

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_key_changes`
--
ALTER TABLE `access_key_changes`
  ADD CONSTRAINT `access_key_changes_access_records_id_fk` FOREIGN KEY (`access_record_id`) REFERENCES `access_records` (`id`);

--
-- Constraints for table `access_records`
--
ALTER TABLE `access_records`
  ADD CONSTRAINT `access_records_applications_id_fk` FOREIGN KEY (`application_id`) REFERENCES `intellivoid`.`applications` (`id`),
  ADD CONSTRAINT `access_records_subscriptions_id_fk` FOREIGN KEY (`subscription_id`) REFERENCES `intellivoid`.`subscriptions` (`id`);

--
-- Constraints for table `exception_records`
--
ALTER TABLE `exception_records`
  ADD CONSTRAINT `exception_records_access_records_id_fk` FOREIGN KEY (`access_record_id`) REFERENCES `access_records` (`id`),
  ADD CONSTRAINT `exception_records_applications_id_fk` FOREIGN KEY (`application_id`) REFERENCES `intellivoid`.`applications` (`id`),
  ADD CONSTRAINT `exception_records_request_records_id_fk` FOREIGN KEY (`request_record_id`) REFERENCES `request_records` (`id`);

--
-- Constraints for table `request_records`
--
ALTER TABLE `request_records`
  ADD CONSTRAINT `request_records_access_records_id_fk` FOREIGN KEY (`access_record_id`) REFERENCES `access_records` (`id`),
  ADD CONSTRAINT `request_records_applications_id_fk` FOREIGN KEY (`application_id`) REFERENCES `intellivoid`.`applications` (`id`);
