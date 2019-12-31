<?php


    namespace IntellivoidAPI\Managers;


    use IntellivoidAPI\IntellivoidAPI;

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
    }