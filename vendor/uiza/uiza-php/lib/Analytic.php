<?php

// namespace Uiza;

// class Analytic extends ApiResource
// {
//     /**
//      * @return string The endpoint URL for the given class.
//      */
//     public static function classUrl()
//     {
//         return "/analytic/entity/video-quality";
//     }

//     public static function resourceUrl()
//     {
//         return Base::getBaseUrl() . self::classUrl();
//     }

//     public static function getTotalLine($params = [])
//     {
//         self::_validateParams('GetTotalLine', $params);
//         $url = static::resourceUrl() . '/total-line-v2';
//         $response = static::_staticRequest('GET', $url, $params);

//         return $response;
//     }

//     public static function getType($params = [])
//     {
//         self::_validateParams('GetType', $params);
//         $url = static::resourceUrl() . '/type';
//         $response = static::_staticRequest('GET', $url, $params);

//         return $response;
//     }

//     public static function getLine($params = [])
//     {
//         self::_validateParams('GetLine', $params);
//         $url = static::resourceUrl() . '/line';
//         $response = static::_staticRequest('GET', $url, $params);

//         return $response;
//     }
// }
