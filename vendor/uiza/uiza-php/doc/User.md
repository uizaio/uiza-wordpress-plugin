## User Management
You can manage user with APIs user.

### Retrieve an user
Retrieves the details of an existing user.
You need only supply the unique userId that was returned upon user creation.

See details [here](https://docs.uiza.io/v4/?php#retrieve-an-user).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $user = Uiza\User::retrieve('id user');

    print_r($user);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### List all users
Returns a list of your user. The users are returned sorted by creation date, with the most recent user appearing first.
If you use Admin token, you will get all the user.
If you use User token, you can only get the information of that user

See details [here](https://docs.uiza.io/v4/?php#list-all-users).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $users = Uiza\User::list(["id" => ""]);

    print_r($users);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Update an user
Updates the specified user by setting the values of the parameters passed. Any parameters not provided will be left unchanged.

See details [here](https://docs.uiza.io/v4/?php#update-an-user).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

$params = [
    "email" => "user_test@gmail.com",
    "status"  => 1,
    "name" => "test",
    "avatar" => "https://exemple.com/avatar.jpeg",
    "dob" => "YYYY-MM-DD"
];

try {
    $user = Uiza\User::update('id user', $params);

    print_r($user);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Update password
Update password allows Admin or User update their current password.

See details [here](https://docs.uiza.io/v4/?php#update-password).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

$params = [
    "userId" => "id user",
    "oldPassword" => "FMpsr<4[dGPu?B#u",
    "newPassword" => "S57Eb{:aMZhW=)G$"
];

try {
    $user = Uiza\User::changePassword($params);

    print_r($user);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Log Out
This API use to log out an user. After logged out, token will be removed.

See details [here](https://docs.uiza.io/v4/?php#log-out).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $response = Uiza\User::logOut();

    print_r($response);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

