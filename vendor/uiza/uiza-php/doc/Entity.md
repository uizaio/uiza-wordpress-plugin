## Entity
These below APIs used to take action with your media files (we called Entity).

See details [here](https://docs.uiza.io/v4/?php#video).

### Create entity.
Create entity using full URL. Direct HTTP, FTP or AWS S3 link are acceptable.

See details [here](https://docs.uiza.io/v4/?php#create-entity).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

$params = [
    "name" => "The Evolution of Dance",
    "url" => "https://sample-videos.com/video123/mp4/720/big_buck_bunny_720p_10mb.mp4",
    "inputType" => "http",
    "description" => "Judson Laipply did a fantastic job in performing various dance moves",
    "shortDescription" => "How good a dancer can you be?"
];

try {
    $entity = Uiza\Entity::create($params);

    print_r($entity);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Retrieve entity
Get detail of entity including all information of entity.

See details [here](https://docs.uiza.io/v4/?php#retrieve-an-entity).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $entity = Uiza\Entity::retrieve('key ... ');

    print_r($entity);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### List all entities.
Get list of entities including all detail.

See details [here](https://docs.uiza.io/v4/?php#list-entities).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $entities = Uiza\Entity::list();

    print_r($entities);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Update entity.
Update entity's information.

See details [here](https://docs.uiza.io/v4/?php#update-an-entity).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

$params = [
    "name" => "The Evolution of Dance 2",
    "description" => "Judson Laipply did it again with a fantastic job in performing better dance moves"
];

try {
    $entity = Uiza\Entity::update('key ..', $params);

    print_r($entity);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Delete entity
Delete entity.

See details [here](https://docs.uiza.io/v4/?php#delete-an-entity).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $response = Uiza\Entity::delete('key ...');

    print_r($response);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Search entity.
Search entity base on keyword entered.

See details [here](https://docs.uiza.io/v4/?php#search-entity).
````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $entities = Uiza\Entity::search(["keyword" => "dance"]);

    print_r($entities);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Publish entity to CDN
Publish entity to CDN, use for streaming.

See details [here](https://docs.uiza.io/v4/?php#publish-entity-to-cdn).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $response = Uiza\Entity::publish(['id' => 'key ..']);

    print_r($response);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Get Status Publish
Publish entity to CDN, use for streaming.

See details [here](https://docs.uiza.io/v4/?php#get-publish-status).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $response = Uiza\Entity::getStatusPublish('key ...');

    print_r($response);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Get AWS Upload Key
This API will be return the bucket temporary upload storage & key for upload, so that you can push your file to Uiza’s storage and get the link for URL upload & create entity.

See details [here](https://docs.uiza.io/v4/?php#get-aws-upload-key).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $response = Uiza\Entity::getAWSUploadKey();

    print_r($response);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````
