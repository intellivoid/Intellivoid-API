<?php


    namespace IntellivoidAPI\Managers;

    use IntellivoidAPI\Abstracts\AccessRecordStatus;
    use IntellivoidAPI\Abstracts\RateLimitName;
    use IntellivoidAPI\Abstracts\SearchMethods\AccessRecordSearchMethod;
    use IntellivoidAPI\Exceptions\AccessRecordNotFoundException;
    use IntellivoidAPI\Exceptions\DatabaseException;
    use IntellivoidAPI\Exceptions\InvalidRateLimitConfiguration;
    use IntellivoidAPI\Exceptions\InvalidSearchMethodException;
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

        /**
         * Returns a access record from the database
         *
         * @param string $search_by
         * @param $value
         * @return AccessRecord
         * @throws AccessRecordNotFoundException
         * @throws DatabaseException
         * @throws InvalidSearchMethodException
         */
        public function getAccessRecord(string $search_by, $value): AccessRecord
        {
            switch($search_by)
            {
                case AccessRecordSearchMethod::byId:
                    $search_by = $this->intellivoidAPI->getDatabase()->real_escape_string($search_by);
                    $value = (int)$value;
                    break;

                case AccessRecordSearchMethod::byAccessKey:
                    $search_by = $this->intellivoidAPI->getDatabase()->real_escape_string($search_by);
                    $value = $this->intellivoidAPI->getDatabase()->real_escape_string($value);
                    break;

                default:
                    throw new InvalidSearchMethodException();
            }

            $Query = QueryBuilder::select('access_records', [
                'id',
                'access_key',
                'last_changed_access_key',
                'application_id',
                'subscription_id',
                'status',
                'variables',
                'rate_limit_type',
                'rate_limit_configuration',
                'last_activity',
                'created'
            ], $search_by, $value);
            $QueryResults = $this->intellivoidAPI->getDatabase()->query($Query);

            if($QueryResults == false)
            {
                throw new DatabaseException($Query, $this->intellivoidAPI->getDatabase()->error);
            }
            else
            {
                if($QueryResults->num_rows !== 1)
                {
                    throw new AccessRecordNotFoundException();
                }

                $Row = $QueryResults->fetch_array(MYSQLI_ASSOC);
                $Row['variables'] = ZiProto::decode($Row['variables']);
                $Row['rate_limit_configuration'] = ZiProto::decode($Row['rate_limit_configuration']);

                return AccessRecord::fromArray($Row);
            }
        }

    }