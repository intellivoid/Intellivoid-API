<?php


    namespace IntellivoidAPI\Objects;


    class AccessRecord
    {
        /**
         * Internal unique database ID for this AccessKey
         *
         * @var int
         */
        public $ID;

        /**
         * Unique access key for authenticating access
         *
         * @var string
         */
        public $AccessKey;

        /**
         * The Unix Timestamp of when the access key was last changed
         *
         * @var int
         */
        public $LastChangedAccessKey;

        /**
         * The Application ID that this Access Record was created for
         *
         * @var int
         */
        public $ApplicationID;

        /**
         * Optional subscription ID that this Access Record is associated with
         *
         * @var int
         */
        public $SubscriptionID;

        /**
         * The status of the Access Record
         *
         * @var int
         */
        public $Status;

        /**
         * Unix Timestamp of when this access record was last used
         *
         * @var int
         */
        public $LastActivity;

        /**
         * The Unix Timestamp of when this access record was created
         *
         * @var int
         */
        public $CreatedTimestamp;

        /**
         * Returns an array which represents this object's structure and values
         *
         * @return array
         */
        public function toArray(): array
        {
            return array(
                'id' => (int)$this->ID,
                'access_key' => $this->AccessKey,
                'last_changed_access_key' => (int)$this->LastActivity,
                'application_id' => (int)$this->ApplicationID,
                'subscription_id' => (int)$this->SubscriptionID,
                'status' => (int)$this->Status,
                'last_activity' => (int)$this->LastActivity,
                'created' => (int)$this->CreatedTimestamp
            );
        }

        /**
         * Constructs
         *
         * @param array $data
         * @return AccessRecord
         */
        public static function fromArray(array $data): AccessRecord
        {
            $AccessRecordObject = new AccessRecord();

            if(isset($data['id']))
            {
                $AccessRecordObject->ID = (int)$data['id'];
            }

            if(isset($data['access_key']))
            {
                $AccessRecordObject->AccessKey = $data['access_key'];
            }

            if(isset($data['last_changed_access_key']))
            {
                $AccessRecordObject->LastChangedAccessKey = (int)$data['last_changed_access_key'];
            }

            if(isset($data['application_id']))
            {
                $AccessRecordObject->ApplicationID = (int)$data['application_id'];
            }

            if(isset($data['subscription_id']))
            {
                $AccessRecordObject->SubscriptionID = (int)$data['subscription_id'];
            }

            if(isset($data['status']))
            {
                $AccessRecordObject->Status = (int)$data['status'];
            }

            if(isset($data['last_activity']))
            {
                $AccessRecordObject->LastActivity = (int)$data['last_activity'];
            }

            if(isset($data['created']))
            {
                $AccessRecordObject->CreatedTimestamp = (int)$data['created'];
            }

            return $AccessRecordObject;
        }
    }