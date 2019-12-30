<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

    // Import Library
    $Source = __DIR__ . DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR . 'src';
    include_once($Source . DIRECTORY_SEPARATOR . 'IntellivoidAPI' . DIRECTORY_SEPARATOR . 'IntellivoidAPI.php');

    $IntellivoidAPI = new \IntellivoidAPI\IntellivoidAPI();

    /** @noinspection PhpUnhandledExceptionInspection */
    $AccessKey = $IntellivoidAPI->getAccessKeyManager()->createAccessRecord(
        0, 0, \IntellivoidAPI\Abstracts\RateLimitName::None, array()
    );

    var_dump($AccessKey);
    exit(0);