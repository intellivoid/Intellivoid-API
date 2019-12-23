<?php


    namespace IntellivoidAPI\Managers;


    use IntellivoidAPI\IntellivoidAPI;

    /**
     * Class ClientKeyManager
     * @package IntellivoidAPI\Managers
     */
    class ClientKeyManager
    {
        /**
         * @var IntellivoidAPI
         */
        private $intellivoidAPI;

        /**
         * ClientKeyManager constructor.
         * @param IntellivoidAPI $intellivoidAPI
         */
        public function __construct(IntellivoidAPI $intellivoidAPI)
        {
            $this->intellivoidAPI = $intellivoidAPI;
        }
    }