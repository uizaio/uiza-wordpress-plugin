<?php

namespace Tests\Uiza;

use \Tests\TestBase;
use \Uiza\User;

class UserTest extends TestBase
{
    protected function setUp()
    {
        parent::setUp();
    }

    public function testRetrieve()
    {
        $return = [
            'data' => [
                'id' => '42ceb1ab-18ef-4f2e-b076-14299756d182',
                "email" => "a_test@uiza.io",
                "dob" => "2018-08-08",
                "name" => "test pass",
                "avatar" => "https://exemple.com/avatar.jpeg",
                "status" => 1,
                "updatedAt" => "2019-03-04T03:20:04.000Z",
                "createdAt" => "2019-03-04T03:20:04.000Z",
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $id = '42ceb1ab-18ef-4f2e-b076-14299756d182';
        $user = User::retrieve($id);

        $this->assertInstanceOf(User::class, $user);

        $this->assertEquals($user->id, $id);
    }

    public function testRetrieveError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $id = '42ceb1ab-18ef-4f2e-b076-14299756d182';
                $user = User::retrieve($id);

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
                    'id' => '42ceb1ab-18ef-4f2e-b076-14299756d182',
                    "email" => "a_test@uiza.io",
                    "dob" => "2018-08-08",
                    "name" => "test pass",
                    "avatar" => "https://exemple.com/avatar.jpeg",
                    "status" => 1,
                    "updatedAt" => "2019-03-04T03:20:04.000Z",
                    "createdAt" => "2019-03-04T03:20:04.000Z",
                ],
                [
                    'id' => '42ceb1ab-18ef-4f2e-b076-14299756d182',
                    "email" => "a_test@uiza.io",
                    "dob" => "2018-08-08",
                    "name" => "test pass",
                    "avatar" => "https://exemple.com/avatar.jpeg",
                    "status" => 1,
                    "updatedAt" => "2019-03-04T03:20:04.000Z",
                    "createdAt" => "2019-03-04T03:20:04.000Z",
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

        $users = User::list(["id" => ""]);

        $this->assertInternalType('array', $users->body->data);
    }

    public function testListError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $users = User::list(["id" => ""]);

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
                'id' => '37d6706e-be91-463e-b3b3-b69451dd4752',
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $params = [
            "email" => "a_test@uiza.io",
            "dob" => "2018-08-08",
            "name" => "update",
            "avatar" => "https://exemple.com/avatar.jpeg",
            "status" => 1
        ];

        $id = '37d6706e-be91-463e-b3b3-b69451dd4752';
        $user = User::update($id, $params);

        $this->assertInstanceOf(User::class, $user);

        $this->assertEquals($user->id, $return['data']['id']);
    }

    public function testUpdateError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $params = [
                    "email" => "a_test@uiza.io",
                    "dob" => "2018-08-08",
                    "name" => "update",
                    "avatar" => "https://exemple.com/avatar.jpeg",
                    "status" => 1
                ];

                $id = '37d6706e-be91-463e-b3b3-b69451dd4752';
                $user = User::update($id, $params);

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

    public function testChangePassword()
    {
        $return = [
            'data' => [
                'id' => '42ceb1ab-18ef-4f2e-b076-14299756d182',
                "email" => "a_test@uiza.io",
                "dob" => "2018-08-08",
                "name" => "test pass",
                "avatar" => "https://exemple.com/avatar.jpeg",
                "status" => 1,
                "updatedAt" => "2019-03-04T03:20:04.000Z",
                "createdAt" => "2019-03-04T03:20:04.000Z",
            ],
            'version' => 4,
            'code' => 200,
            'message' => 'OK',
        ];

        $this->mockData($return);

        $params = [
            "userId" => "42ceb1ab-18ef-4f2e-b076-14299756d182",
            "oldPassword" => "FMpsr<4[dGPu?B#u",
            "newPassword" => "S57Eb{:aMZhW=)G$"
        ];

        $user = User::changePassword($params);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($user->id, $return['data']['id']);
    }

    public function testChangePasswordError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $params = [
                    "userId" => "42ceb1ab-18ef-4f2e-b076-14299756d182",
                    "oldPassword" => "FMpsr<4[dGPu?B#u",
                    "newPassword" => "S57Eb{:aMZhW=)G$"
                ];

                $user = User::changePassword($params);

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

    public function testLogOut()
    {
        $return = [
            "data" => [
                "message" => "success",
            ],
            "version" => 4,
            "message" => "Logout success",
            "code" => 200
        ];

        $this->mockData($return);

        $user = User::logOut();

        $this->assertEquals($user->body->code, $return['code']);
    }

    public function testLogOutError()
    {
        $statusCode = $this->statusCode();

        foreach ($statusCode as $key => $value) {
            $this->mockDataError($key);

            try {
                $user = User::logOut();

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
