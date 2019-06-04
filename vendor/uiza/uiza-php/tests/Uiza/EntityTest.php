<?php

namespace Tests\Uiza;

use \Tests\TestBase;
use \Uiza\Entity;

class EntityTest extends TestBase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function testList()
    {
        $return = [
            'data' => [
                [
                    'id' => '42ceb1ab-18ef-4f2e-b076-14299756d182',
                    'name' => 'Sample Video 1',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy',
                    'view' => 0,
                    'embedMetadata' => [
                        'artist' => 'John Doe',
                        'album' => 'Album sample',
                        'genre' => 'Pop'
                    ],
                ],
                [
                    'id' => '42ceb1ab-18ef-4f2e-b076-14299756d182',
                    'name' => 'Sample Video 2',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy',
                    'view' => 0,
                    'embedMetadata' => [
                        'artist' => 'John Doe',
                        'album' => 'Album sample',
                        'genre' => 'Pop'
                    ],
                ],
            ],
            'metadata' => [
                'total' => 2,
                'result' => 2,
                'page' => 1,
                'limit' => 20,
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $entitys = Entity::list(['publishToCdn' => 'queue']);

        $this->assertInternalType('array', $entitys->body->data);
    }

    public function testListError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $entity = Entity::list(['publishToCdn' => 'queue']);

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
            'name' => 'ngoc2',
            'url' => 'https://stackoverflow.com/questions/41836785/why-i-cant-convert-this-object-representing-a-web-service-response-into-strin',
            'inputType' => 'http',
        ];

        $entity = Entity::create($params);

        $this->assertInstanceOf(Entity::class, $entity);

        $this->assertEquals($entity->id, $return['data']['id']);
    }

    public function testCreateError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $params = [
                    'name' => 'ngoc2',
                    'url' => 'https://stackoverflow.com/questions/41836785/why-i-cant-convert-this-object-representing-a-web-service-response-into-strin',
                    'inputType' => 'http',
                ];

                $entity = Entity::create($params);

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
                'id' => '42ceb1ab-18ef-4f2e-b076-14299756d182',
                'name' => 'Name',
                'description' => 'Change desc',
                'embedMetadata' => [
                    'artist' =>  'John Doe',
                    'album' =>  'Album sample',
                    'genre' => 'Pop'
                ]
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $id = '42ceb1ab-18ef-4f2e-b076-14299756d182';
        $entity = Entity::retrieve($id);

        $this->assertInstanceOf(Entity::class, $entity);

        $this->assertEquals($entity->id, $id);
    }

    public function testRetrieveError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $id = '42ceb1ab-18ef-4f2e-b076-14299756d182';
                $entity = Entity::retrieve($id);

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
                'id' => '42ceb1ab-18ef-4f2e-b076-14299756d182',
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $id = '42ceb1ab-18ef-4f2e-b076-14299756d182';
        $params = [
            'name' => 'Name edited',
            'description' => 'Change desc',
        ];

        $entity = Entity::update($id, $params);

        $this->assertInstanceOf(Entity::class, $entity);

        $this->assertEquals($entity->id, $return['data']['id']);
    }

    public function testUpdateError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $id = '42ceb1ab-18ef-4f2e-b076-14299756d182';
                $params = [
                    'name' => 'Name edited',
                    'description' => 'Change desc',
                ];

                $entity = Entity::update($id, $params);

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
                'id' => '42ceb1ab-18ef-4f2e-b076-14299756d182',
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $id = '42ceb1ab-18ef-4f2e-b076-14299756d182';
        $entity = Entity::delete($id);

        $this->assertEquals($entity->id, $return['data']['id']);
    }

    public function testDeleteError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $id = '42ceb1ab-18ef-4f2e-b076-14299756d182';
                $entity = Entity::delete($id);

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

    public function testSearch()
    {
        $return = [
            'data' => [
                [
                    'id' => '42ceb1ab-18ef-4f2e-b076-14299756d182',
                    'name' => 'Sample Video 1',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy',
                    'view' => 0,
                    'embedMetadata' => [
                        'artist' => 'John Doe',
                        'album' => 'Album sample',
                        'genre' => 'Pop'
                    ],
                ],
                [
                    'id' => '42ceb1ab-18ef-4f2e-b076-14299756d182',
                    'name' => 'Sample Video 2',
                    'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy',
                    'view' => 0,
                    'embedMetadata' => [
                        'artist' => 'John Doe',
                        'album' => 'Album sample',
                        'genre' => 'Pop'
                    ],
                ],
            ],
            'metadata' => [
                'total' => 2,
                'result' => 2,
                'page' => 1,
                'limit' => 20,
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $entitys = Entity::search(['keyword' => 'sample']);

        $this->assertInternalType('array', $entitys->body->data);
    }

    public function testSearchError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $entitys = Entity::search(['keyword' => 'sample']);

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

    public function testPublish()
    {
        $return = [
            'data' => [
                'id' => '42ceb1ab-18ef-4f2e-b076-14299756d182',
                "message" => "Your entity started publish, check process status with this entity ID",
                "entityId" => "42ceb1ab-18ef-4f2e-b076-14299756d182"
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $entity = Entity::publish(['id' => '42ceb1ab-18ef-4f2e-b076-14299756d182']);

        $this->assertEquals($entity->id, $return['data']['id']);
    }

    public function testPublishError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $entity = Entity::publish(['id' => '42ceb1ab-18ef-4f2e-b076-14299756d182']);

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

    public function testGetStatusPublish()
    {
        $return = [
            'data' => [
                "progress" => 0,
                "status" => "processing"
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $id = '42ceb1ab-18ef-4f2e-b076-14299756d182';
        $entity = Entity::getStatusPublish($id);

        $this->assertEquals($entity->progress, $return['data']['progress']);
    }

    public function testGetStatusPublishError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $id = '42ceb1ab-18ef-4f2e-b076-14299756d182';
                $entity = Entity::getStatusPublish($id);

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

    public function testGetAWSUploadKey()
    {
        $return = [
            'data' => [
                "temp_expire_at" => 1533658598,
                "temp_access_id" => "ADAFAGAGJHAGF",
                "bucket_name" => "bucket name",
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $entity = Entity::getAWSUploadKey();

        $this->assertEquals($entity->body->data->temp_access_id, $return['data']['temp_access_id']);
    }

    public function testGetAWSUploadKeyError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $entity = Entity::getAWSUploadKey();

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
