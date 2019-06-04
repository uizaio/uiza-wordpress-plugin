## Live Streaming
These APIs used to create and manage live streaming event.
* When a Live is not start : it's named as `Event`.
* When have an Event , you can start it : it's named as `Feed`.

See details [here](https://docs.uiza.io/v4/?php#live-streaming).

### Create a live event

These APIs use to create a live streaming and manage the live streaming input (output). A live stream can be set up and start later or start right after set up. Live Channel Minutes counts when the event starts.

See details [here](https://docs.uiza.io/v4/?php#create-a-live-event).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

$params = [
    "name" => "test event",
    "mode" => "push",
    "encode" => 1,
    "dvr" => 1,
    "description" => "This is for test event",
    "poster" => "//image1.jpeg",
    "thumbnail" => "//image1.jpeg",
    "linkStream" => [
              "https://playlist.m3u8"
            ],
    "resourceMode" => "single"
];
try {
    $live = Uiza\Live::create($params);

    print_r($live);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Retrieve a live event

Retrieves the details of an existing event. You need only provide the unique identifier of event that was returned upon Live event creation.

See details [here](https://docs.uiza.io/v4/?php#retrieve-a-live-event).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $live = Uiza\Live::retrieve('key ... ');

    print_r($live);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Update a live event

Update the specific Live event by edit values of parameters.

See details [here](https://docs.uiza.io/v4/?php#update-a-live-event).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

$params = [
    "name" => "live test",
    "mode" => "pull",
    "encode" => 0,
    "dvr" => 1,
    "resourceMode" => "single"
];

try {
    $live = Uiza\Live::update('key ..', $params);

    print_r($live);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Start a live feed

These API use to start a live event that has been create success. The Live channel minute start count whenever the event start success

See details [here](https://docs.uiza.io/v4/?php#start-a-live-feed).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $response = Uiza\Live::startFeed(['id' => 'your entityId...']);

    print_r($response);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Get view of live feed

This API use to get a live view status . This view only show when event has been started and being processing.

See details [here](https://docs.uiza.io/v4/?php#retrieve-views).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $response = Uiza\Live::getView(['id' => 'your entityId...']);

    print_r($response);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Stop a live feed

Stop live event

See details [here](https://docs.uiza.io/v4/?php#stop-a-live-feed).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $response = Uiza\Live::stopFeed(['id' => 'your entityId...']);

    print_r($response);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### List all recorded files

Retrieves list of recorded file after streamed (only available when your live event has turned on Record feature)

See details [here](https://docs.uiza.io/v4/?php#list-recorded-files).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $recordeds = Uiza\Live::listRecorded();

    print_r($recordeds);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Delete a record file

Delete a recorded file

See details [here](https://docs.uiza.io/v4/?php#delete-a-record-file).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $response = Uiza\Live::delete('id record ...');

    print_r($response);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Convert into VOD

Convert recorded file into VOD entity. After converted, your file can be stream via Uiza's CDN.

See details [here](https://docs.uiza.io/v4/?php#convert-into-vod).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $entity = Uiza\Live::convertToVOD(['id' => 'your entityId...']);

    print_r($entity);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````
