<?php


    namespace IntellivoidAPI\Managers;


    use IntellivoidAPI\IntellivoidAPI;
    use IntellivoidAPI\Objects\RequestRecord;
    use IntellivoidAPI\Objects\RequestRecordEntry;
    use IntellivoidAPI\Utilities\Validate;
    use ZiProto\ZiProto;

    /**
     * Class RequestRecordManager
     * @package IntellivoidAPI\Managers
     */
    class RequestRecordManager
    {
        /**
         * @var IntellivoidAPI
         */
        private $intellivoidAPI;

        /**
         * RequestRecordManager constructor.
         * @param IntellivoidAPI $intellivoidAPI
         */
        public function __construct(IntellivoidAPI $intellivoidAPI)
        {
            $this->intellivoidAPI = $intellivoidAPI;
        }

        public function logRecord(RequestRecordEntry $requestRecordEntry): bool
        {
            $access_record_id = 0;
            $application_id = 0;
            $request_method = "Unknown";
            $version = "Unknown";
            $path = "Unknown";
            $request_payload = array();
            $ip_address = "Unknown";
            $user_agent = "Unknown";
            $response_code = 0;
            $response_content_type = "Unknown";
            $response_length = 0;
            $response_time = (float)0;

            if($requestRecordEntry->AccessRecordID !== null)
            {
                $access_record_id = (int)$requestRecordEntry->AccessRecordID;
            }

            if($requestRecordEntry->ApplicationID !== null)
            {
                $application_id = (int)$requestRecordEntry->ApplicationID;
            }

            if($requestRecordEntry->RequestMethod !== null)
            {
                if(strlen($requestRecordEntry->RequestMethod) > 1)
                {
                    if(strlen($requestRecordEntry->RequestMethod) < 20)
                    {
                        $request_method = $this->intellivoidAPI->getDatabase()->real_escape_string($requestRecordEntry->RequestMethod);
                    }
                }
            }

            if($requestRecordEntry->Version !== null)
            {
                if(strlen($requestRecordEntry->Version) > 1)
                {
                    if(strlen($requestRecordEntry->Version) < 20)
                    {
                        $version = $this->intellivoidAPI->getDatabase()->real_escape_string($requestRecordEntry->Version);
                    }
                }
            }

            if($requestRecordEntry->Path !== null)
            {
                if(strlen($requestRecordEntry->Path) > 1)
                {
                    if(strlen($requestRecordEntry->Path) < 255)
                    {
                        $path = $this->intellivoidAPI->getDatabase()->real_escape_string($requestRecordEntry->Path);
                    }
                }
            }


            if($requestRecordEntry->RequestPayload == null)
            {
                $requestRecordEntry->RequestPayload = array();
            }

            $request_payload = ZiProto::encode($requestRecordEntry->RequestPayload);
            $request_payload = $this->intellivoidAPI->getDatabase()->real_escape_string($request_payload);

            if(Validate::ip_address($requestRecordEntry->IPAddress))
            {
                $ip_address = $requestRecordEntry->IPAddress;
                $ip_address = $this->intellivoidAPI->getDatabase()->real_escape_string($ip_address);
            }

            if(strlen($requestRecordEntry->UserAgent) < 526)
            {
                $user_agent = base64_encode($requestRecordEntry->UserAgent);
                $user_agent = $this->intellivoidAPI->getDatabase()->real_escape_string($user_agent);
            }

            if($requestRecordEntry->ResponseCode == null)
            {
                $response_code = 0;
            }
            else
            {
                $response_code = (int)$requestRecordEntry->ResponseCode;
            }

            if($requestRecordEntry->ResponseContentType !== null)
            {
                if(strlen($requestRecordEntry->ResponseContentType) > 1)
                {
                    if(strlen($requestRecordEntry->ResponseContentType) < 255)
                    {
                        $response_content_type = $this->intellivoidAPI->getDatabase()->real_escape_string($requestRecordEntry->ResponseContentType);
                    }
                }
            }

            if($requestRecordEntry->ResponseLength == null)
            {
                $response_length = 0;
            }
            else
            {
                $response_length = (int)$requestRecordEntry->ResponseLength;
            }

            if($requestRecordEntry->ResponseTime == null)
            {
                $response_time = (float)0;
            }
            else
            {
                $response_time = (float)$requestRecordEntry->ResponseTime;
            }



        }
    }