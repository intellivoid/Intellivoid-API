create table exception_records
(
    id                int(255) auto_increment comment 'The internal unique database ID for this exception record',
    request_record_id int(255)      null comment 'The request record ID that raised this unexpected exception',
    application_id    int(255)      null comment 'The Application ID responsible for handling the request, 0 = None',
    access_record_id  int(255)      null comment 'The ID of the access record that created the request, 0 = None',
    message           varchar(2526) null comment 'The message that the exception has returned',
    file              varchar(1526) null comment 'The location of the affected file',
    line              int(255)      null comment 'The line where the exception was thrown',
    code              int(255)      null comment 'The exception code returned by the exception',
    trace             blob          null comment 'Exception trace which is encoded in ZiProto',
    timestamp         int(255)      null comment 'The Unix Timestamp for when this record was created',
    constraint exception_records_id_uindex unique (id)
) comment 'Uncaught exceptions that are logged in this table';
alter table exception_records add primary key (id);