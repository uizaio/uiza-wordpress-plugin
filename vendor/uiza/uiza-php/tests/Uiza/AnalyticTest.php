<?php

// namespace Tests\Uiza;

// use \Tests\TestBase;
// use \Uiza\Analytic;

// class AnalyticTest extends TestBase
// {
//     protected function setUp()
//     {
//         parent::setUp();
//     }

//     public function testGetTotalLine()
//     {
//         $return = [
//             'data' => [
//                 [
//                     "date_time" => 1551322800000,
//                     "rebuffer_count" => 419.125
//                 ],
//                 [
//                      "date_time" => 1551405600000,
//                     "rebuffer_count" => 0.5
//                 ]
//             ],
//             "version" => 3,
//             "code" => 200,
//             "message"=> "Successfully"
//         ];

//         $this->mockData($return);

//         $params = [
//             'start_date' => '2019-03-01 08:00',
//             'end_date' => '2019-03-04 20:00',
//             'metric' => 'rebuffer_count'
//         ];

//         $analytic = Analytic::getTotalLine($params);

//         $this->assertInternalType('array', $analytic->body->data);
//     }

//     public function testGetTotalLineError()
//     {
//         $statusCode = $this->statusCode();

//         foreach ($statusCode as $key => $value) {
//             $this->mockDataError($key);

//             try {
//                 $params = [
//                     'start_date' => '2019-03-01 08:00',
//                     'end_date' => '2019-03-04 20:00',
//                     'metric' => 'rebuffer_count'
//                 ];

//                 $analytic = Analytic::getTotalLine($params);

//             } catch (\Uiza\Exception\BadRequestError $e) {
//                 $this->assertEquals($e->statusCode, 400);
//             } catch (\Uiza\Exception\UnauthorizedError $e) {
//                 $this->assertEquals($e->statusCode, 401);
//             } catch (\Uiza\Exception\NotFoundError $e) {
//                 $this->assertEquals($e->statusCode, 404);
//             } catch (\Uiza\Exception\UnprocessableError $e) {
//                 $this->assertEquals($e->statusCode, 422);
//             } catch (\Uiza\Exception\InternalServerError $e) {
//                 $this->assertEquals($e->statusCode, 500);
//             } catch (\Uiza\Exception\ServiceUnavailableError $e) {
//                 $this->assertEquals($e->statusCode, 503);
//             } catch (\Uiza\Exception\ClientError $e) {
//                 $this->assertEquals($e->statusCode, $key);
//             } catch (\Uiza\Exception\ServerError $e) {
//                 $this->assertEquals($e->statusCode, $key);
//             }
//         }
//     }

//     public function testGetType()
//     {
//         $return = [
//             'data' => [
//                 [
//                     "name" => "14.161.42.46",
//                     "total_view" => 3,
//                     "percentage_of_view" => 0.15
//                 ],
//                 [
//                     "name" => "14.161.0.68",
//                     "total_view" => 10,
//                     "percentage_of_view" => 0.5
//                 ],
//             ],
//             "version" => 3,
//             "code" => 200,
//             "message"=> "Successfully"
//         ];

//         $this->mockData($return);

//         $params = [
//             'start_date' => '2019-03-01',
//             'end_date' => '2019-03-04',
//             'type_filter' => 'country'
//         ];

//         $analytic = Analytic::getType($params);

//         $this->assertInternalType('array', $analytic->body->data);
//     }

//     public function testGetTypeError()
//     {
//         $statusCode = $this->statusCode();

//         foreach ($statusCode as $key => $value) {
//             $this->mockDataError($key);

//             try {
//                 $params = [
//                     'start_date' => '2019-03-01',
//                     'end_date' => '2019-03-04',
//                     'type_filter' => 'country'
//                 ];

//                 $analytic = Analytic::getType($params);

//             } catch (\Uiza\Exception\BadRequestError $e) {
//                 $this->assertEquals($e->statusCode, 400);
//             } catch (\Uiza\Exception\UnauthorizedError $e) {
//                 $this->assertEquals($e->statusCode, 401);
//             } catch (\Uiza\Exception\NotFoundError $e) {
//                 $this->assertEquals($e->statusCode, 404);
//             } catch (\Uiza\Exception\UnprocessableError $e) {
//                 $this->assertEquals($e->statusCode, 422);
//             } catch (\Uiza\Exception\InternalServerError $e) {
//                 $this->assertEquals($e->statusCode, 500);
//             } catch (\Uiza\Exception\ServiceUnavailableError $e) {
//                 $this->assertEquals($e->statusCode, 503);
//             } catch (\Uiza\Exception\ClientError $e) {
//                 $this->assertEquals($e->statusCode, $key);
//             } catch (\Uiza\Exception\ServerError $e) {
//                 $this->assertEquals($e->statusCode, $key);
//             }
//         }
//     }

//     public function testGetLine()
//     {
//         $return = [
//             'data' => [
//                 [
//                     "date_time" => 1551312000000,
//                     "value" => 372.55555555555554
//                 ],
//                 [
//                     "date_time" => 1551398400000,
//                     "value" => 0.9090909090909091
//                 ],
//             ],
//             "version" => 3,
//             "code" => 200,
//             "message"=> "Successfully"
//         ];

//         $this->mockData($return);

//         $params = [
//             'start_date' => '2019-03-01',
//             'end_date' => '2019-03-04',
//             'type' => 'rebuffer_count'
//         ];

//         $analytic = Analytic::getLine($params);

//         $this->assertInternalType('array', $analytic->body->data);
//     }

//     public function testGetLineError()
//     {
//         $statusCode = $this->statusCode();

//         foreach ($statusCode as $key => $value) {
//             $this->mockDataError($key);

//             try {
//                 $params = [
//                     'start_date' => '2019-03-01',
//                     'end_date' => '2019-03-04',
//                     'type' => 'rebuffer_count'
//                 ];

//                 $analytic = Analytic::getLine($params);

//             } catch (\Uiza\Exception\BadRequestError $e) {
//                 $this->assertEquals($e->statusCode, 400);
//             } catch (\Uiza\Exception\UnauthorizedError $e) {
//                 $this->assertEquals($e->statusCode, 401);
//             } catch (\Uiza\Exception\NotFoundError $e) {
//                 $this->assertEquals($e->statusCode, 404);
//             } catch (\Uiza\Exception\UnprocessableError $e) {
//                 $this->assertEquals($e->statusCode, 422);
//             } catch (\Uiza\Exception\InternalServerError $e) {
//                 $this->assertEquals($e->statusCode, 500);
//             } catch (\Uiza\Exception\ServiceUnavailableError $e) {
//                 $this->assertEquals($e->statusCode, 503);
//             } catch (\Uiza\Exception\ClientError $e) {
//                 $this->assertEquals($e->statusCode, $key);
//             } catch (\Uiza\Exception\ServerError $e) {
//                 $this->assertEquals($e->statusCode, $key);
//             }
//         }
//     }
// }
