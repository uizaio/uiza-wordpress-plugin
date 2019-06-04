<?php

namespace Tests\Uiza;

use \Tests\TestBase;
use \Uiza\Category;

class CategoryTest extends TestBase
{

    protected function setUp()
    {
        parent::setUp();
    }

    public function testCreate()
    {
        $return = [
            'data' => [
                'id' => '42ceb1ab-18ef-4f2e-b076-14299756d182',
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $params = [
            "name" => "Folder sample",
            "type" => "folder",
            "description" => "Folder description",
            "orderNumber" => 1,
            "icon" => "https://exemple.com/icon.png"
        ];

        $category = Category::create($params);

        $this->assertInstanceOf(Category::class, $category);

        $this->assertEquals($category->id, $return['data']['id']);
    }

    public function testCreateError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $params = [
                    "name" => "Folder sample",
                    "type" => "folder",
                    "description" => "Folder description",
                    "orderNumber" => 1,
                    "icon" => "https://exemple.com/icon.png"
                ];

                $category = Category::create($params);

            } catch (\Uiza\Exception\BadRequestError $e) {
                $this->assertEquals($e->statusCode, 400);
            } catch (\Uiza\Exception\UnauthorizedError $e) {
                $this->assertEquals($e->statusCode, 401);
            } catch (\Uiza\Exception\NotFoundError $e) {
                $this->assertEquals($e->statusCode, 404);
            } catch (\Uiza\Exception\UnprocessableError $e) {
                $this->assertEquals($e->statusCode, 422);
            } catch (\Uiza\Exception\InternalServerError $e) {
                $this->assertEquals($e->statusCode, 500);
            } catch (\Uiza\Exception\ServiceUnavailableError $e) {
                $this->assertEquals($e->statusCode, 503);
            } catch (\Uiza\Exception\ClientError $e) {
                $this->assertEquals($e->statusCode, $key);
            } catch (\Uiza\Exception\ServerError $e) {
                $this->assertEquals($e->statusCode, $key);
            }
        }
    }

    public function testRetrieve()
    {
        $return = [
            'data' => [
                "id" => "f932aa79-852a-41f7-9adc-19935034f944",
                "name" => "Playlist sample",
                "description" => "Playlist description",
                "slug" => "playlist-sample",
                "type" => "playlist",
                "orderNumber" => 3,
                "icon" => "https:///example.com/image002.png",
                "status" => 1,
                "createdAt" => "2018-06-18T04:29:05.000Z",
                "updatedAt" => "2018-06-18T04:29:05.000Z"
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $id = 'f932aa79-852a-41f7-9adc-19935034f944';
        $category = Category::retrieve($id);

        $this->assertInstanceOf(Category::class, $category);

        $this->assertEquals($category->id, $id);
    }

    public function testRetrieveError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $id = 'f932aa79-852a-41f7-9adc-19935034f944';
                $category = Category::retrieve($id);

            } catch (\Uiza\Exception\BadRequestError $e) {
                $this->assertEquals($e->statusCode, 400);
            } catch (\Uiza\Exception\UnauthorizedError $e) {
                $this->assertEquals($e->statusCode, 401);
            } catch (\Uiza\Exception\NotFoundError $e) {
                $this->assertEquals($e->statusCode, 404);
            } catch (\Uiza\Exception\UnprocessableError $e) {
                $this->assertEquals($e->statusCode, 422);
            } catch (\Uiza\Exception\InternalServerError $e) {
                $this->assertEquals($e->statusCode, 500);
            } catch (\Uiza\Exception\ServiceUnavailableError $e) {
                $this->assertEquals($e->statusCode, 503);
            } catch (\Uiza\Exception\ClientError $e) {
                $this->assertEquals($e->statusCode, $key);
            } catch (\Uiza\Exception\ServerError $e) {
                $this->assertEquals($e->statusCode, $key);
            }
        }
    }

    public function testList()
    {
        $return = [
            'data' => [
                [
                    "id" => "f932aa79-852a-41f7-9adc-19935034f944",
                    "name" => "Playlist sample",
                    "description" => "Playlist desciption",
                    "slug" => "playlist-sample",
                    "type" => "playlist",
                    "orderNumber" => 3,
                    "icon" => "/example.com/image002.png",
                    "status" => 1,
                    "createdAt" => "2018-06-18T04:29:05.000Z",
                    "updatedAt" => "2018-06-18T04:29:05.000Z"
                ],
                [
                    "id" => "ab54db88-0c8c-4928-b1be-1e7120ad2c39",
                    "name" => "Folder sample",
                    "description" => "Folder's description",
                    "slug" => "folder-sample",
                    "type" => "folder",
                    "orderNumber" => 1,
                    "icon" => "/example.com/icon.png",
                    "status" => 1,
                    "createdAt" => "2018-06-18T03:17:07.000Z",
                    "updatedAt" => "2018-06-18T03:17:07.000Z"
                ]
            ],
            'metadata' => [
                "total" => 2,
                "result" => 2,
                "page" => 1,
                "limit" => 20
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $categories = Category::list();

        $this->assertInternalType('array', $categories->body->data);
    }

    public function testListError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $categories = Category::list();

            } catch (\Uiza\Exception\BadRequestError $e) {
                $this->assertEquals($e->statusCode, 400);
            } catch (\Uiza\Exception\UnauthorizedError $e) {
                $this->assertEquals($e->statusCode, 401);
            } catch (\Uiza\Exception\NotFoundError $e) {
                $this->assertEquals($e->statusCode, 404);
            } catch (\Uiza\Exception\UnprocessableError $e) {
                $this->assertEquals($e->statusCode, 422);
            } catch (\Uiza\Exception\InternalServerError $e) {
                $this->assertEquals($e->statusCode, 500);
            } catch (\Uiza\Exception\ServiceUnavailableError $e) {
                $this->assertEquals($e->statusCode, 503);
            } catch (\Uiza\Exception\ClientError $e) {
                $this->assertEquals($e->statusCode, $key);
            } catch (\Uiza\Exception\ServerError $e) {
                $this->assertEquals($e->statusCode, $key);
            }
        }
    }

    public function testUpdate()
    {
        $return = [
            'data' => [
                'id' => '095778fa-7e42-45cc-8a0e-6118e540b61d',
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $id = '095778fa-7e42-45cc-8a0e-6118e540b61d';
        $params = [
            "name" => "Folder edited",
            "type" => "folder",
            "description" => "Folder description new",
            "orderNumber" => 1,
            "icon" => "/exemple.com/icon_001.png"
        ];

        $category = Category::update($id, $params);

        $this->assertInstanceOf(Category::class, $category);

        $this->assertEquals($category->id, $return['data']['id']);
    }

    public function testUpdateError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $id = '095778fa-7e42-45cc-8a0e-6118e540b61d';
                $params = [
                    "name" => "Folder edited",
                    "type" => "folder",
                    "description" => "Folder description new",
                    "orderNumber" => 1,
                    "icon" => "/exemple.com/icon_001.png"
                ];

                $category = Category::update($id, $params);

            } catch (\Uiza\Exception\BadRequestError $e) {
                $this->assertEquals($e->statusCode, 400);
            } catch (\Uiza\Exception\UnauthorizedError $e) {
                $this->assertEquals($e->statusCode, 401);
            } catch (\Uiza\Exception\NotFoundError $e) {
                $this->assertEquals($e->statusCode, 404);
            } catch (\Uiza\Exception\UnprocessableError $e) {
                $this->assertEquals($e->statusCode, 422);
            } catch (\Uiza\Exception\InternalServerError $e) {
                $this->assertEquals($e->statusCode, 500);
            } catch (\Uiza\Exception\ServiceUnavailableError $e) {
                $this->assertEquals($e->statusCode, 503);
            } catch (\Uiza\Exception\ClientError $e) {
                $this->assertEquals($e->statusCode, $key);
            } catch (\Uiza\Exception\ServerError $e) {
                $this->assertEquals($e->statusCode, $key);
            }
        }
    }

    public function testDelete()
    {
        $return = [
            'data' => [
                'id' => '095778fa-7e42-45cc-8a0e-6118e540b61d',
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $id = '095778fa-7e42-45cc-8a0e-6118e540b61d';
        $category = Category::delete($id);

        $this->assertEquals($category->id, $return['data']['id']);
    }

    public function testDeleteError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $id = '095778fa-7e42-45cc-8a0e-6118e540b61d';
                $category = Category::delete($id);

            } catch (\Uiza\Exception\BadRequestError $e) {
                $this->assertEquals($e->statusCode, 400);
            } catch (\Uiza\Exception\UnauthorizedError $e) {
                $this->assertEquals($e->statusCode, 401);
            } catch (\Uiza\Exception\NotFoundError $e) {
                $this->assertEquals($e->statusCode, 404);
            } catch (\Uiza\Exception\UnprocessableError $e) {
                $this->assertEquals($e->statusCode, 422);
            } catch (\Uiza\Exception\InternalServerError $e) {
                $this->assertEquals($e->statusCode, 500);
            } catch (\Uiza\Exception\ServiceUnavailableError $e) {
                $this->assertEquals($e->statusCode, 503);
            } catch (\Uiza\Exception\ClientError $e) {
                $this->assertEquals($e->statusCode, $key);
            } catch (\Uiza\Exception\ServerError $e) {
                $this->assertEquals($e->statusCode, $key);
            }
        }
    }

    public function testCreateRelation()
    {
        $return = [
            'data' => [
                [
                    "id" => "5620ed3c-b725-4a9a-8ec1-ecc9df3e5aa6",
                    "entityId" => "16ab25d3-fd0f-4568-8aa0-0339bbfd674f",
                    "metadataId" => "095778fa-7e42-45cc-8a0e-6118e540b61d"
                ],
                [
                    "id" => "47209e60-a99f-4c96-99fb-be4f858481b4",
                    "entityId" => "16ab25d3-fd0f-4568-8aa0-0339bbfd674f",
                    "metadataId" => "e00586b9-032a-46a3-af71-d275f01b03cf"
                ]
            ],
            'metadata' => [
                "total" => 2,
                "result" => 2,
                "page" => 1,
                "limit" => 20
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $params = [
            "entityId" => "16ab25d3-fd0f-4568-8aa0-0339bbfd674f",
            "metadataIds" => ["095778fa-7e42-45cc-8a0e-6118e540b61d","e00586b9-032a-46a3-af71-d275f01b03cf"]
        ];

        $categories = Category::createRelation($params);

        $this->assertInternalType('array', $categories->body->data);
        $this->assertEquals($categories->body->metadata->total, $return['metadata']['total']);
    }

    public function testCreateRelationError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $params = [
                    "entityId" => "16ab25d3-fd0f-4568-8aa0-0339bbfd674f",
                    "metadataIds" => ["095778fa-7e42-45cc-8a0e-6118e540b61d","e00586b9-032a-46a3-af71-d275f01b03cf"]
                ];

                $categories = Category::createRelation($params);

            } catch (\Uiza\Exception\BadRequestError $e) {
                $this->assertEquals($e->statusCode, 400);
            } catch (\Uiza\Exception\UnauthorizedError $e) {
                $this->assertEquals($e->statusCode, 401);
            } catch (\Uiza\Exception\NotFoundError $e) {
                $this->assertEquals($e->statusCode, 404);
            } catch (\Uiza\Exception\UnprocessableError $e) {
                $this->assertEquals($e->statusCode, 422);
            } catch (\Uiza\Exception\InternalServerError $e) {
                $this->assertEquals($e->statusCode, 500);
            } catch (\Uiza\Exception\ServiceUnavailableError $e) {
                $this->assertEquals($e->statusCode, 503);
            } catch (\Uiza\Exception\ClientError $e) {
                $this->assertEquals($e->statusCode, $key);
            } catch (\Uiza\Exception\ServerError $e) {
                $this->assertEquals($e->statusCode, $key);
            }
        }
    }

    public function testDeleteRelation()
    {
        $return = [
            'data' => [
                [
                    "id" => "5620ed3c-b725-4a9a-8ec1-ecc9df3e5aa6",
                    "entityId" => "16ab25d3-fd0f-4568-8aa0-0339bbfd674f",
                    "metadataId" => "095778fa-7e42-45cc-8a0e-6118e540b61d"
                ],
            ],
            'metadata' => [
                "total" => 1,
                "result" => 1,
                "page" => 1,
                "limit" => 20
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $params = [
            "entityId" => "16ab25d3-fd0f-4568-8aa0-0339bbfd674f",
            "metadataIds" => ["095778fa-7e42-45cc-8a0e-6118e540b61d"]
        ];

        $categories = Category::deleteRelation($params);

        $this->assertInternalType('array', $categories->body->data);
        $this->assertEquals($categories->body->metadata->total, $return['metadata']['total']);
    }

    public function testDeleteRelationError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $params = [
                    "entityId" => "16ab25d3-fd0f-4568-8aa0-0339bbfd674f",
                    "metadataIds" => ["095778fa-7e42-45cc-8a0e-6118e540b61d"]
                ];

                $categories = Category::deleteRelation($params);

            } catch (\Uiza\Exception\BadRequestError $e) {
                $this->assertEquals($e->statusCode, 400);
            } catch (\Uiza\Exception\UnauthorizedError $e) {
                $this->assertEquals($e->statusCode, 401);
            } catch (\Uiza\Exception\NotFoundError $e) {
                $this->assertEquals($e->statusCode, 404);
            } catch (\Uiza\Exception\UnprocessableError $e) {
                $this->assertEquals($e->statusCode, 422);
            } catch (\Uiza\Exception\InternalServerError $e) {
                $this->assertEquals($e->statusCode, 500);
            } catch (\Uiza\Exception\ServiceUnavailableError $e) {
                $this->assertEquals($e->statusCode, 503);
            } catch (\Uiza\Exception\ClientError $e) {
                $this->assertEquals($e->statusCode, $key);
            } catch (\Uiza\Exception\ServerError $e) {
                $this->assertEquals($e->statusCode, $key);
            }
        }
    }
}
