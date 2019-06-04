## Callback

Callback used to retrieve an information for Uiza to your server, so you can have a trigger notice about an entity is upload completed and .

See details [here](https://docs.uiza.io/v4/?php#callback).

### Create a callback

This API will allow you setup a callback to your server when an entity is completed for upload or public

See details [here](https://docs.uiza.io/v4/?php#create-a-callback).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

$params = [
    "url" => "https://callback-url.uiza.co",
    "method" => "POST",
    "jsonData" => [
        "data" => "Example json data"
    ],
    "headersData" => [
        "data" => "Example headers data"
    ]
];

try {
    $callback = Uiza\Callback::create($params);

    print_r($callback);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Retrieve a callback

Retrieves the details of an existing callback.

See details [here](https://docs.uiza.io/v4/?php#retrieve-a-callback).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $callback = Uiza\Callback::retrieve('id callback');

    print_r($callback);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Update a callback

Updates the specified callback by setting the values of the parameters passed. Any parameters not provided will be left unchanged.

See details [here](https://docs.uiza.io/v4/?php#update-a-callback).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

$params = [
    "url" => "https://callback-url.uiza.co",
    "method" => "POST",
    "jsonData" => [
        "data" => "Example json data updated"
    ],
    "headersData" => [
        "data" => "Example headers data updated"
    ]
];

try {
    $callback = Uiza\Callback::update('id callback', $params);

    print_r($callback);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Delete a callback

Delete an existing callback.

See details [here](https://docs.uiza.io/v4/?php#delete-a-callback).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $response = Uiza\Callback::delete('id callback');

    print_r($response);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````
