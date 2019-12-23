<?php


    namespace IntellivoidAPI;


    use acm\acm;
    use Exception;

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
        }
    }