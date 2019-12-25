<?php


    namespace IntellivoidAPI\Managers;

    use IntellivoidAPI\Abstracts\AccessRecordStatus;
    use IntellivoidAPI\Abstracts\RateLimitName;
    use IntellivoidAPI\Exceptions\DatabaseException;
    use IntellivoidAPI\Exceptions\InvalidRateLimitConfiguration;
    use IntellivoidAPI\IntellivoidAPI;
    use IntellivoidAPI\Objects\AccessRecord;
    use IntellivoidAPI\Objects\RateLimitTypes\IntervalLimit;
    use IntellivoidAPI\Utilities\Hashing;
    use msqg\QueryBuilder;
    use ZiProto\ZiProto;

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

        /**
         * Creates a new Access Record
         *
         * @param int $application_id
         * @param int $subscription_id
         * @param string $rate_limit_type
         * @param array $rate_limit_configuration
         * @return AccessRecord
         * @throws DatabaseException
         * @throws InvalidRateLimitConfiguration
         */
        public function createAccessRecord(int $application_id, $subscription_id=0, string $rate_limit_type=RateLimitName::None, array $rate_limit_configuration=array()): AccessRecord
        {
            $creation_timestamp = (int)time();
            $last_activity = 0;
            $application_id = (int)0;

            $access_key = Hashing::generateAccessKey($application_id, $creation_timestamp, 0);
            $last_changed_access_key = 0;

            switch($rate_limit_type)
            {
                case RateLimitName::None:
                    $rate_limit_type = $this->intellivoidAPI->getDatabase()->real_escape_string(RateLimitName::None);
                    $rate_limit_configuration = ZiProto::encode(array());
                    $rate_limit_configuration = $this->intellivoidAPI->getDatabase()->real_escape_string($rate_limit_configuration);
                    break;

                case RateLimitName::IntervalLimit:
                    $rate_limit_type = $this->intellivoidAPI->getDatabase()->real_escape_string(RateLimitName::IntervalLimit);

                    /** @var IntervalLimit $rate_limit_configuration */
                    $rate_limit_configuration = ZiProto::encode($rate_limit_configuration->toArray());
                    $rate_limit_configuration = $this->intellivoidAPI->getDatabase()->real_escape_string($rate_limit_configuration);
                    break;

                default:
                    throw new InvalidRateLimitConfiguration();
            }

            $status = (int)AccessRecordStatus::Available;
            $subscription_id = (int)$subscription_id;
            $variables = ZiProto::encode(array());
            $variables = $this->intellivoidAPI->getDatabase()->real_escape_string($variables);

            $Query = QueryBuilder::insert_into('access_records', array(
                'access_key' => $access_key,
                'application_id' => $application_id,
                'created' => $creation_timestamp,
                'last_activity' => $last_activity,
                'last_changed_access_key' => $last_changed_access_key,
                'rate_limit_configuration' => $rate_limit_configuration,
                'rate_limit_type' =>  $rate_limit_type,
                'status' => $status,
                'subscription_id' => $subscription_id,
                'variables' => $variables
            ));
            $QueryResults = $this->intellivoidAPI->getDatabase()->query($Query);

            if($QueryResults == true)
            {
                // TODO: Return access record that was created
                return null;
            }
            else
            {
                throw new DatabaseException($Query, $this->intellivoidAPI->getDatabase()->error);
            }
        }

    }