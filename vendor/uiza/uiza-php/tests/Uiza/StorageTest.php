<?php

namespace Tests\Uiza;

use \Tests\TestBase;
use \Uiza\Storage;

class StorageTest extends TestBase
{

    protected function setUp()
    {
        parent::setUp();
    }

    public function testAdd()
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
            "name" => "FTP Uiza",
            "description" => "FTP of Uiza, use for transcode",
            "storageType" => "ftp",
            "host" => "ftp-example.uiza.io",
            "username" => "uiza",
            "password" => "=59x@LPsd+w7qW",
            "port" => 21
        ];

        $storage = Storage::create($params);

        $this->assertInstanceOf(Storage::class, $storage);

        $this->assertEquals($storage->id, $return['data']['id']);
    }

    public function testAddError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $params = [
                    "name" => "FTP Uiza",
                    "description" => "FTP of Uiza, use for transcode",
                    "storageType" => "ftp",
                    "host" => "ftp-example.uiza.io",
                    "username" => "uiza",
                    "password" => "=59x@LPsd+w7qW",
                    "port" => 21
                ];

                $storage = Storage::create($params);

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
                "name" => "FTP Uiza",
                "description" => "FTP of Uiza, use for transcode",
                "storageType" => "ftp",
                "usageType" => "input",
                "bucket" => null,
                "prefix" => null,
                "host" => "ftp-exemple.uiza.io",
                "awsAccessKey" => null,
                "awsSecretKey" => null,
                "username" => "uiza",
                "password" => "=5;9x@LPsd+w7qW",
                "region" => null,
                "port" => 21,
                "createdAt" => "2018-06-19T03:01:56.000Z",
                "updatedAt" => "2018-06-19T03:01:56.000Z"
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $storage = Storage::retrieve('42ceb1ab-18ef-4f2e-b076-14299756d182');

        $this->assertInstanceOf(Storage::class, $storage);

        $this->assertEquals($storage->id, $return['data']['id']);
    }

    public function testRetrieveError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $storage = Storage::retrieve('42ceb1ab-18ef-4f2e-b076-14299756d182');

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

        $params = [
            "name" => "FTP Uiza",
            "description" => "FTP of Uiza, use for transcode",
            "storageType" => "ftp",
            "host" => "ftp-example.uiza.io",
            "username" => "uiza",
            "password" => "=5;'9x@LPsd+w7qW",
            "port" => 21
        ];

        $storage = Storage::update('42ceb1ab-18ef-4f2e-b076-14299756d182', $params);

        $this->assertInstanceOf(Storage::class, $storage);

        $this->assertEquals($storage->id, $return['data']['id']);
    }

    public function testUpdateError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $params = [
                    "name" => "FTP Uiza",
                    "description" => "FTP of Uiza, use for transcode",
                    "storageType" => "ftp",
                    "host" => "ftp-example.uiza.io",
                    "username" => "uiza",
                    "password" => "=5;'9x@LPsd+w7qW",
                    "port" => 21
                ];

                $storage = Storage::update('42ceb1ab-18ef-4f2e-b076-14299756d182', $params);

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

        $storage = Storage::delete('42ceb1ab-18ef-4f2e-b076-14299756d182');

        $this->assertEquals($storage->id, $return['data']['id']);
    }

    public function testDeleteError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $storage = Storage::delete('42ceb1ab-18ef-4f2e-b076-14299756d182');

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
