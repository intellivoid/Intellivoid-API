<?php


    namespace IntellivoidAPI;


    use acm\acm;
    use Exception;
    use mysqli;

    $LocalDirectory = __DIR__ . DIRECTORY_SEPARATOR;

    if(class_exists('acm\acm') == false)
    {
        include_once(__DIR__ . DIRECTORY_SEPARATOR . 'acm' . DIRECTORY_SEPARATOR . 'acm.php');
    }

    /**
     * Class IntellivoidAPI
     * @package IntellivoidAPI
     */
    class IntellivoidAPI
    {
        /**
         * @var acm
         */
        private $acm;

        /**
         * @var mixed
         */
        private $DatabaseConfiguration;

        /**
         * @var mysqli
         */
        private $database;

        /**
         * IntellivoidAPI constructor.
         */
        public function __construct()
        {
            $this->acm = new acm(__DIR__, 'Intellivoid Accounts');

            try
            {
                $this->DatabaseConfiguration = $this->acm->getConfiguration('Database');
            }
            catch (Exception $e)
            {
                print("There was an error while trying to parse the ACM configuration");
                print($e->getMessage());
                exit(0);
            }

            $this->database = new mysqli(
                $this->DatabaseConfiguration['Host'],
                $this->DatabaseConfiguration['Username'],
                $this->DatabaseConfiguration['Password'],
                $this->DatabaseConfiguration['Name'],
                $this->DatabaseConfiguration['Port']
            );
        }

        /**
         * @return acm
         */
        public function getAcm()
        {
            return $this->acm;
        }

        /**
         * @return mixed
         */
        public function getDatabaseConfiguration()
        {
            return $this->DatabaseConfiguration;
        }

        /**
         * @return mysqli
         */
        public function getDatabase()
        {
            return $this->database;
        }


    }