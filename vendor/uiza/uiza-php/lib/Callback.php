<?php

namespace Uiza;

class Callback extends ApiResource
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
        return "/media/entity/callback";
    }

    public static function resourceUrl()
    {
        return Base::getBaseUrl() . self::classUrl();
    }
}
