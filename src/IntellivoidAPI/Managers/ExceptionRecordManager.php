<?php


    namespace IntellivoidAPI\Managers;


    use Exception;
    use IntellivoidAPI\Exceptions\DatabaseException;
    use IntellivoidAPI\IntellivoidAPI;
    use IntellivoidAPI\Objects\AccessRecord;
    use msqg\QueryBuilder;
    use ZiProto\ZiProto;

    /**
     * Class ExceptionRecordManager
     * @package IntellivoidAPI\Managers
     */
    class ExceptionRecordManager
    {
        /**
         * @var IntellivoidAPI
         */
        private $intellivoidAPI;

        /**
         * ExceptionRecordManager constructor.
         * @param IntellivoidAPI $intellivoidAPI
         */
        public function __construct(IntellivoidAPI $intellivoidAPI)
        {
            $this->intellivoidAPI = $intellivoidAPI;
        }

        /**
         * Records an exception and saves the details to the database
         *
         * @param int $requestRecordID
         * @param AccessRecord $accessRecord
         * @param Exception $exception
         * @return bool
         * @throws DatabaseException
         */
        public function recordException(int $requestRecordID, AccessRecord $accessRecord, Exception $exception)
        {
            $application_id = (int)0;

            if($accessRecord->ID !== 0)
            {
                $application_id = (int)$accessRecord->ApplicationID;
            }

            $access_record_id = (int)$accessRecord->ID;
            $request_record_id = (int)$requestRecordID;

            $message = $this->intellivoidAPI->getDatabase()->real_escape_string($exception->getMessage());
            $file = $this->intellivoidAPI->getDatabase()->real_escape_string($exception->getFile());
            $line = (int)$exception->getLine();
            $code = (int)$exception->getCode();
            $trace = $this->intellivoidAPI->getDatabase()->real_escape_string(ZiProto::encode($exception->getTrace()));
            $timestamp = (int)time();

            $Query = QueryBuilder::insert_into('exception_records', array(
                'request_record_id' => $request_record_id,
                'application_id' => $application_id,
                'access_record_id' => $access_record_id,
                'message' => $message,
                'file' => $file,
                'line' => $line,
                'code' => $code,
                'trace' => $trace,
                'timestamp' => $timestamp
            ));
            $QueryResults = $this->intellivoidAPI->getDatabase()->query($Query);

            if($QueryResults == true)
            {
                return true;
            }
            else
            {
                throw new DatabaseException($Query, $this->intellivoidAPI->getDatabase()->error);
            }
        }
    }