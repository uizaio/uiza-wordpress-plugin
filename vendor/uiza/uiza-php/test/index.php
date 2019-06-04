<?php

require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $params = [
        'name' => 'Name entity',
        'url' => 'http://google.com',
        'inputType' => 'http',
    ];

    var_dump(Uiza\Entity::create($params));
} catch (\Uiza\Exception\ErrorResponse $e) {
    print($e);
}

