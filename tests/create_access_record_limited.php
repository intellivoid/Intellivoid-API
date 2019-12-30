<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

    // Import Library
    $Source = __DIR__ . DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR . 'src';
    include_once($Source . DIRECTORY_SEPARATOR . 'IntellivoidAPI' . DIRECTORY_SEPARATOR . 'IntellivoidAPI.php');

    $IntellivoidAPI = new \IntellivoidAPI\IntellivoidAPI();

    $IntervalLimitConfiguration = \IntellivoidAPI\Objects\RateLimitTypes\IntervalLimit::create(60, 10);

    /** @noinspection PhpUnhandledExceptionInspection */
    $AccessKey = $IntellivoidAPI->getAccessKeyManager()->createAccessRecord(
        0, 0, \IntellivoidAPI\Abstracts\RateLimitName::IntervalLimit,
        $IntervalLimitConfiguration->toArray()
    );

    var_dump($AccessKey);
    exit(0);