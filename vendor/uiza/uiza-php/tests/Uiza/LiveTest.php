<?php

namespace Tests\Uiza;

use \Tests\TestBase;
use \Uiza\Live;

class LiveTest extends TestBase
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

        $live = Live::create($params);

        $this->assertInstanceOf(Live::class, $live);

        $this->assertEquals($live->id, $return['data']['id']);
    }

    public function testCreateError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
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

                $live = Live::create($params);

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
            "data" => [
                "id" => "8b83886e-9cc3-4eab-9258-ebb16c0c73de",
                "name" => "checking 01",
                "description" => "checking",
                "mode" => "pull",
                "resourceMode" => "single",
                "encode" => 0,
                "channelName" => "checking-01",
                "lastPresetId" => null,
                "lastFeedId" => null,
                "poster" => "https://example.com/poster.jpeg",
                "thumbnail" => "https://example.com/thumbnail.jpeg",
                "linkPublishSocial" => null,
                "linkStream" => "[\"https://www.youtube.com/watch?v=pQzaHPoNX1I\"]",
                "lastPullInfo" => null,
                "lastPushInfo" => null,
                "lastProcess" => null,
                "eventType" => null,
                "createdAt" => "2018-06-21T14:33:36.000Z",
                "updatedAt" => "2018-06-21T14:33:36.000Z"
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $id = '8b83886e-9cc3-4eab-9258-ebb16c0c73de';
        $live = Live::retrieve($id);

        $this->assertInstanceOf(Live::class, $live);

        $this->assertEquals($live->id, $id);
    }

    public function testRetrieveError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $id = '8b83886e-9cc3-4eab-9258-ebb16c0c73de';
                $live = Live::retrieve($id);

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
                'id' => '8b83886e-9cc3-4eab-9258-ebb16c0c73de',
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $id = '8b83886e-9cc3-4eab-9258-ebb16c0c73de';
        $params = [
            "name" => "live test",
            "mode" => "pull",
            "encode" => 0,
            "dvr" => 1,
            "resourceMode" => "single"
        ];

        $live = Live::update($id, $params);

        $this->assertInstanceOf(Live::class, $live);

        $this->assertEquals($live->id, $return['data']['id']);
    }

    public function testUpdateError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $id = '8b83886e-9cc3-4eab-9258-ebb16c0c73de';
                $params = [
                    "name" => "live test",
                    "mode" => "pull",
                    "encode" => 0,
                    "dvr" => 1,
                    "resourceMode" => "single"
                ];

                $live = Live::update($id, $params);

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

    public function testStartFeed()
    {
        $return = [
            'data' => [
                'id' => '8b83886e-9cc3-4eab-9258-ebb16c0c73de',
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $live = Live::startFeed(['id' => '8b83886e-9cc3-4eab-9258-ebb16c0c73de']);

        $this->assertInstanceOf(Live::class, $live);

        $this->assertEquals($live->id, $return['data']['id']);
    }

    public function testStartFeedError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $live = Live::startFeed(['id' => '8b83886e-9cc3-4eab-9258-ebb16c0c73de']);

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

    public function testStopFeed()
    {
        $return = [
            'data' => [
                'id' => '8b83886e-9cc3-4eab-9258-ebb16c0c73de',
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $live = Live::stopFeed(['id' => '8b83886e-9cc3-4eab-9258-ebb16c0c73de']);

        $this->assertInstanceOf(Live::class, $live);

        $this->assertEquals($live->id, $return['data']['id']);
    }

    public function testStopFeedError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $live = Live::stopFeed(['id' => '8b83886e-9cc3-4eab-9258-ebb16c0c73de']);

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

    public function testGetView()
    {
        $return = [
            'data' => [
                "stream_name" => "peppa-pig-english-episodes",
                "watchnow" => 1,
                "day" => 1533271205999
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $live = Live::getView(['id' => '8b83886e-9cc3-4eab-9258-ebb16c0c73de']);

        $this->assertInstanceOf(Live::class, $live);
    }

    public function testGetViewError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $live = Live::getView(['id' => '8b83886e-9cc3-4eab-9258-ebb16c0c73de']);

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

    public function testListRecorded()
    {
        $return = [
            'data' => [
                [
                    "id" => "040df935-61c4-46f7-a41f-0a899ebaa2cc",
                    "entityId" => "ee122e85-553f-4621-bc77-1396191d5846",
                    "channelName" => "dcb8686f-d0f8-4a0f-8b92-22db339eb315",
                    "feedId" => "3e3b75df-e6fa-471c-b386-8f44b8a34b6c",
                    "eventType" => "pull",
                    "startTime" => "2018-12-13T16:28:29.000Z",
                    "endTime" => "2018-12-13T18:28:29.000Z",
                    "length" => "7200",
                    "fileSize" => "9276182",
                    "extraInfo" => null,
                    "endpointConfig" => "s3-uiza-dvr",
                    "createdAt" => "2018-12-13T19:28:43.000Z",
                    "updatedAt" => "2018-12-13T19:28:43.000Z",
                    "entityName" => "Christmas 2018 Holidays Special | Best Christmas Songs & Cartoons for Kids & Babies on Baby First TV"
                ],
                [
                    "id" => "3fec45e9-932b-4efe-b97f-dc3053acaa05",
                    "entityId" => "47e804bc-d4e5-4442-8f1f-20341a156a70",
                    "channelName" => "e9034eac-4905-4f9a-8e79-c0bd67e49dd5",
                    "feedId" => "12830696-87e3-4209-a877-954f8f008964",
                    "eventType" => "pull",
                    "startTime" => "2018-12-13T14:14:14.000Z",
                    "endTime" => "2018-12-13T16:14:14.000Z",
                    "length" => "7200",
                    "fileSize" => "439858038",
                    "extraInfo" => null,
                    "endpointConfig" => "s3-uiza-dvr",
                    "createdAt" => "2018-12-13T17:30:42.000Z",
                    "updatedAt" => "2018-12-13T17:30:42.000Z",
                    "entityName" => "WATCH: SpaceX to Launch Falcon 9 Rocket #Spaceflight CRS16 @1:16pm EST"
                ]
            ],
            "metadata" => [
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

        $lives = Live::listRecorded();

        $this->assertInternalType('array', $lives->body->data);
    }

    public function testListRecordedError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $lives = Live::listRecorded();

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
                'id' => '8b83886e-9cc3-4eab-9258-ebb16c0c73de',
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $live = Live::delete('8b83886e-9cc3-4eab-9258-ebb16c0c73de');

        $this->assertInstanceOf(Live::class, $live);

        $this->assertEquals($live->id, $return['data']['id']);
    }

    public function testDeleteError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $live = Live::delete('8b83886e-9cc3-4eab-9258-ebb16c0c73de');

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

    public function testConvertToVOD()
    {
        $return = [
            'data' => [
                'id' => '8b83886e-9cc3-4eab-9258-ebb16c0c73de',
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $live = Live::convertToVOD(['id' => '8b83886e-9cc3-4eab-9258-ebb16c0c73de']);

        $this->assertInstanceOf(Live::class, $live);

        $this->assertEquals($live->id, $return['data']['id']);
    }

    public function testConvertToVODError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $live = Live::convertToVOD(['id' => '8b83886e-9cc3-4eab-9258-ebb16c0c73de']);

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
