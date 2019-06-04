## Storage
You can add your storage (FTP, AWS S3) with UIZA.
After synced, you can select your content easier from your storage to [create entity](https://docs.uiza.io/v4/?php#create-entity).

See details [here](https://docs.uiza.io/v4/?php#storage).

### Add Storage
You can sync your storage (FTP, AWS S3) with UIZA.\
After synced, you can select your content easier from your storage to [create entity](https://docs.uiza.io/v4/?php#create-entity).

See details [here](https://docs.uiza.io/v4/?php#add-a-storage).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

$params = [
    "name" => "FTP Uiza",
    "description" => "FTP of Uiza, use for transcode",
    "storageType" => "ftp",
    "host" => "ftp-example.uiza.io",
    "username" => "uiza",
    "password" => "=59x@LPsd+w7qW",
    "port" => 21
];

try {
    $storage = Uiza\Storage::add($params);

    print_r($storage);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Retrieve Storage
Get information of your added storage (FTP or AWS S3).

See details [here](https://docs.uiza.io/v4/?php#retrieve-a-storage).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $storage = Uiza\Storage::retrieve('key ... ');

    print_r($storage);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Update Storage
Update storage's information.

See details [here](https://docs.uiza.io/v4/?php#update-storage).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

$params = [
    "name" => "FTP Uiza update",
    "description" => "FTP of Uiza, use for transcode update",
    "storageType" => "ftp"
];

try {
    $storage = Uiza\Storage::update('key ..', $params);

    print_r($storage);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Remove Storage
Remove storage that added to Uiza.

See details [here](https://docs.uiza.io/v4/?php#delete-a-storage).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $response = Uiza\Storage::remove('key ...');

    print_r($response);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````
