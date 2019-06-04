<?php

namespace Uiza;

class Entity extends ApiResource
{
    use \Uiza\ApiOperation\Create;
    use \Uiza\ApiOperation\Update;
    use \Uiza\ApiOperation\Retrieve;
    use \Uiza\ApiOperation\Delete;
    use \Uiza\ApiOperation\All;

    /**
     * @return string The endpoint URL for the given class.
     */
    public static function classUrl()
    {
        return "/media/entity";
    }

    public static function resourceUrl()
    {
        return Base::getBaseUrl() . self::classUrl();
    }

    public static function search($params = [])
    {
        self::_validateParams('Search', $params);
        $params = array_merge($params, [ 'appId' => \Uiza\Base::$appId ]);
        $url = static::resourceUrl() . '/search';
        $response = static::_staticRequest('GET', $url, $params);

        return $response;
    }

    public static function publish($params = [])
    {
        self::_validateParams('Publish', $params);
        $params = array_merge($params, [ 'appId' => \Uiza\Base::$appId ]);
        $url = static::resourceUrl() . '/publish';
        $response = static::_staticRequest('POST', $url, $params);
        $instance = new static($params['id']);
        $instance->refreshFrom($response->body);
        $instance->setLastResponse($response);

        return $instance;
    }

    public static function getStatusPublish($id, $params = [])
    {
        $params = array_merge($params,[
            'id' => $id,
            'appId' => \Uiza\Base::$appId
        ]);
        self::_validateParams('GetStatusPublish', $params);
        $url = static::resourceUrl() . '/publish/status';
        $response = static::_staticRequest('GET', $url, $params);
        $instance = new static($id);
        $instance->refreshFrom($response->body);
        $instance->setLastResponse($response);

        return $instance;
    }

    public static function getAWSUploadKey($params = [])
    {
        $url = Base::getBaseUrl(). 'admin/app/config/aws';
        $params = array_merge($params, [ 'appId' => \Uiza\Base::$appId ]);
        $response = static::_staticRequest('GET', $url, $params);

        return $response;
    }

    /**
     * @return array A recursive mapping of attributes to values for this object,
     *    including the proper value for deleted attributes.
     */
    public function serializeParameters()
    {
        $updateParams = [];
        $keys = $this->_unsavedValues->toArray();

        foreach ($keys as $key) {
            $updateParams += [$key => $this->_values[$key]];
        }

        $updateParams = array_merge($updateParams, [
            'id' => $this['id'],
            'appId' => \Uiza\Base::$appId
        ]);

        return $updateParams;
    }

    public static function validateAll($params = [])
    {
        $pubArr = ['queue', 'not-ready', 'success', 'failed'];
        if (array_key_exists('publishToCdn', $params)) {
            if (!in_array($params['publishToCdn'], $pubArr)) {
                throw new \Uiza\Exception\InvalidParam('publishToCdn is one of value: queue, not-ready, success, failed ');
            }
        }
    }

    public static function validatePublish($params = [])
    {
        if (!array_key_exists('id', $params)) {
            throw new \Uiza\Exception\InvalidParam('id is required');
        }
    }

    public static function validateSearch($params = [])
    {
        if (!array_key_exists('keyword', $params)
            || (array_key_exists('keyword', $params) && $params['keyword'] == '')) {
            throw new \Uiza\Exception\InvalidParam('keyword is required');
        }
    }

    public static function validateCreate($params = [])
    {
        if (!array_key_exists('name', $params)) {
            throw new \Uiza\Exception\InvalidParam('Name is required');
        }

        if (!array_key_exists('url', $params)) {
            throw new \Uiza\Exception\InvalidParam('Url is required');
        }

        $inputType = ["http", "s3", "ftp", "s3-uiza"];

        if (!array_key_exists('inputType', $params)) {
            throw new \Uiza\Exception\InvalidParam('inputType is required');
        } else {
            if (!in_array($params['inputType'], $inputType)) {
                throw new \Uiza\Exception\InvalidParam('inputType is must belong http, s3, ftp, s3-uiza.');
            }
        }
    }
}
