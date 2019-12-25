<?php


    namespace IntellivoidAPI\Managers;

    use IntellivoidAPI\Abstracts\RateLimitName;
    use IntellivoidAPI\IntellivoidAPI;
    use IntellivoidAPI\Objects\AccessRecord;

    /**
     * Class AccessKeyManager
     * @package IntellivoidAPI\Managers
     */
    class AccessRecordManager
    {
        /**
         * @var IntellivoidAPI
         */
        private $intellivoidAPI;

        /**
         * AccessKeyManager constructor.
         * @param IntellivoidAPI $intellivoidAPI
         */
        public function __construct(IntellivoidAPI $intellivoidAPI)
        {
            $this->intellivoidAPI = $intellivoidAPI;
        }

        public function createAccessRecord(int $application_id, string $rate_limit_type=RateLimitName::None, array $rate_limit_configuration=array()): AccessRecord
        {
            $creation_timestamp = (int)time();
            $last_activity = 0;
            $application_id = (int)0;

            $access_key =
        }

    }