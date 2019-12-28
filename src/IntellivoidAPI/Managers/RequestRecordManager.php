<?php


    namespace IntellivoidAPI\Managers;


    use IntellivoidAPI\IntellivoidAPI;
    use IntellivoidAPI\Objects\RequestRecord;
    use IntellivoidAPI\Objects\RequestRecordEntry;

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

        }
    }