<?php


    namespace IntellivoidAPI\Utilities;

    /**
     * Class Hashing
     * @package IntellivoidAPI\Utilities
     */
    class Hashing
    {
        /**
         * Peppers a hash using whirlpool
         *
         * @param string $Data The hash to pepper
         * @param int $Min Minimal amounts of executions
         * @param int $Max Maximum amount of executions
         * @return string
         */
        public static function pepper(string $Data, int $Min = 100, int $Max = 1000): string
        {
            $n = rand($Min, $Max);
            $res = '';
            $Data = hash('whirlpool', $Data);
            for ($i=0,$l=strlen($Data) ; $l ; $l--)
            {
                $i = ($i+$n-1) % $l;
                $res = $res . $Data[$i];
                $Data = ($i ? substr($Data, 0, $i) : '') . ($i < $l-1 ? substr($Data, $i+1) : '');
            }
            return($res);
        }

        /**
         * Generates an access key, the ID is optional
         *
         * @param int $application_id
         * @param int $timestamp
         * @param int $id
         * @return string
         */
        public static function generateAccessKey(int $application_id, int $timestamp, int $id=0): string
        {
            $first_part = hash('crc32b', $application_id);
            $second_part = hash('crc32b', $id);
            $pepper =  self::pepper($first_part . $second_part . $timestamp);
            return hash('sha512', $first_part . $second_part . $timestamp . $pepper);
        }
    }