<?php

namespace Uiza\ApiOperation;
use Uiza\Util\Collection;

trait All
{
    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return \Uiza\Collection of ApiResources
     */
    public static function all($params = [], $convertObj = false)
    {
        self::_validateParams('All', $params);
        $params['appId'] = \Uiza\Base::$appId;
        $url = static::resourceUrl();
        $response = static::_staticRequest('GET', $url, $params);

        if ($convertObj) {
            $newResponse = new Collection();
            foreach ($response->body->data as $key => $value) {
                $instance = new static;
                $instance->refreshFrom($value);
                $instance->setLastResponse($response);
                $newResponse->add($value);
            }

            return $newResponse;
        }

        return $response;
    }

    /**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return \Uiza\Collection of ApiResources
     */
    public static function list($params = [], $convertObj = false)
    {
        return self::all($params, $convertObj);
    }
}
