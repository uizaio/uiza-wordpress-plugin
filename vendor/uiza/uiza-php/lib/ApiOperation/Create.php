<?php

namespace Uiza\ApiOperation;

trait Create {
    /**
     * @param array|null $params
     * @param array|string|null $options
     *
     * @return \Uiza\ApiResource The created resource.
     */
    public static function create($params = [], $options = null)
    {
        self::_validateParams('Create', $params);
        $params = array_merge($params, [ 'appId' => \Uiza\Base::$appId ]);
        $url = static::resourceUrl();
        $response = static::_staticRequest('POST', $url, $params, $options);

        $instance = new static;
        $instance->refreshFrom($response->body);
        $instance->setLastResponse($response);

        return $instance;
    }
}
