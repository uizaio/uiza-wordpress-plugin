## Category
Category has been splits into 4 types: folder, playlist, tag and category. These will make the management of entity more easier.

See details [here](https://docs.uiza.io/v4/?php#categorization).

### Create Category
Create category for entity for easier management.\
Category use to group all the same entities into a group (like Folder/playlist/category or tag).

See details [here](https://docs.uiza.io/v4/?php#create-category).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

$params = [
    "name" => "Folder sample",
    "type" => "folder",
    "description" => "Folder description",
    "orderNumber" => 1
];

try {
    $category = Uiza\Category::create($params);

    print_r($category);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Retrieve Category
Retrieve the details of an existing category. Supply the unique category ID from either an category creation request or the category list, and Uiza will return the corresponding category information.

See details [here](https://docs.uiza.io/v4/?php#retrieve-category).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $category = Uiza\Category::retrieve('key ... ');

    print_r($category);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### List categories
Returns a list of your categories. The categories are returned sorted by orderNumber, with the smallest orderNumber appearing first.

See details [here](https://docs.uiza.io/v4/?php#list-categories).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $categorygories =  Uiza\Category::list();

    print_r($categories);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Update Category
Update information of category

See details [here](https://docs.uiza.io/v4/?php#update-a-category).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

$params = [
    "name" => "Folder edited",
    "type" => "folder",
    "description" => "Folder description new",
    "orderNumber" => 1
];

try {
    $category = Uiza\Category::update('key ..', $params);

    print_r($category);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Delete Category
Delete category

See details [here](https://docs.uiza.io/v4/?php#delete-a-category).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

try {
    $response = Uiza\Category::delete('key ...');

    print_r($response);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Create Category Relation
Add relation for entity and category

See details [here](https://docs.uiza.io/v4/?php#create-category-relation).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

$params = [
    "entityId" => "16ab25d3-fd0f-4568-8aa0-0339bbfd674f",
    "metadataIds" => ["095778fa-7e42-45cc-8a0e-6118e540b61d","e00586b9-032a-46a3-af71-d275f01b03cf"]
];

try {
    $relations = Uiza\Category::createRelation($params);

    print_r($relations);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````

### Delete Category Relation
Delete relation for entity and category

See details [here](https://docs.uiza.io/v4/?php#delete-category-relation).

````
require __DIR__."/../vendor/autoload.php";

Uiza\Base::setAppId('your-app-id');
Uiza\Base::setAuthorization('your-authorization');

$params = [
    "entityId" => "16ab25d3-fd0f-4568-8aa0-0339bbfd674f",
    "metadataIds" => ["095778fa-7e42-45cc-8a0e-6118e540b61d","e00586b9-032a-46a3-af71-d275f01b03cf"]
];

try {
    $response = Uiza\Category::deleteRelation($params);

    print_r($response);
} catch(\Uiza\Exception\ErrorResponse $e) {
    print($e);
}
````
