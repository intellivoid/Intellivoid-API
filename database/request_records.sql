create table request_records
(
    id                    int(255) auto_increment comment 'The unique internal database ID for this record',
    reference_id          varchar(255) null comment 'The public reference ID for this request record',
    access_record_id      int(255)     null comment 'The ID of the access record that created this request (0 = None)',
    application_id        int(255)     null comment 'The ID of the application that this request is for (0 = None)',
    request_method        varchar(255) null comment 'The HTTP Request method used to make this request',
    request_payload       blob         null comment 'Zi Proto encoded data of the GET/POST payload sent from the client',
    ip_address            varchar(255) null comment 'The IP Address that was used to create the request',
    user_agent            varchar(255) null comment 'Base64 Encoded data of the User Agent that was used (512 Characters max)',
    response_code         int(255)     null comment 'The response code that was used after the request has been completed',
    response_content_type varchar(255) null comment 'The content type given in the response',
    response_length       int(255)     null comment 'The length of the response in bytes',
    response_time         float        null comment 'The time it took to process the request',
    day                   int(255)     null comment 'The date of the day that this response took place in',
    month                 int(255)     null comment 'The date of the month that this request took place in',
    year                  int(255)     null comment 'The date of the year that this response took place in',
    timestamp             int(255)     null comment 'The Unix Timestamp of when this request took place in',
    constraint request_records_id_uindex unique (id)
) comment 'Table of API Requests records';
alter table request_records add primary key (id);