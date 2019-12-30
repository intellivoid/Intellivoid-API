<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

    // Import Library
    $Source = __DIR__ . DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR . 'src';
    include_once($Source . DIRECTORY_SEPARATOR . 'IntellivoidAPI' . DIRECTORY_SEPARATOR . 'IntellivoidAPI.php');

    $IntellivoidAPI = new \IntellivoidAPI\IntellivoidAPI();

    $AccessRecordID = 1;

    /** @noinspection PhpUnhandledExceptionInspection */
    $AccessRecord = $IntellivoidAPI->getAccessKeyManager()->getAccessRecord(
        \IntellivoidAPI\Abstracts\SearchMethods\AccessRecordSearchMethod::byId, $AccessRecordID
    );

    /** @noinspection PhpUnhandledExceptionInspection */
    $AccessRecord = $IntellivoidAPI->getAccessKeyManager()->generateNewAccessKey($AccessRecord);

    var_dump($AccessRecord);
    exit(0);