
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
