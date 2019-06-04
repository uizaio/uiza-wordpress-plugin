<?php

namespace Uiza;

class Storage extends ApiResource
{
    use \Uiza\ApiOperation\Create;
    use \Uiza\ApiOperation\Retrieve;
    use \Uiza\ApiOperation\Update;
    use \Uiza\ApiOperation\Delete;

    /**
     * @return string The endpoint URL for the given class.
     */
    public static function classUrl()
    {
        return "/media/storage";
    }

    public static function resourceUrl()
    {
        return Base::getBaseUrl() . self::classUrl();
    }

    public static function add($params = null, $options = null)
    {
        return self::create($params, $options);
    }

    public static function remove($id, $params = null)
    {
        return self::delete($id, $params);
    }
}
