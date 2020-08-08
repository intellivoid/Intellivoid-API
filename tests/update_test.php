<?php /** @noinspection PhpFullyQualifiedNameUsageInspection */

    // Import Library
    $Source = __DIR__ . DIRECTORY_SEPARATOR . '..' .DIRECTORY_SEPARATOR . 'src';
    include_once($Source . DIRECTORY_SEPARATOR . 'IntellivoidAPI' . DIRECTORY_SEPARATOR . 'IntellivoidAPI.php');

    $IntellivoidAPI = new \IntellivoidAPI\IntellivoidAPI();

    $AccessKey = $IntellivoidAPI->getAccessKeyManager()->getAccessRecord(\IntellivoidAPI\Abstracts\SearchMethods\AccessRecordSearchMethod::byId, 391);
    var_dump($AccessKey);