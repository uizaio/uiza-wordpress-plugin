<?php
namespace Uiza;

class ApiResource extends UizaObject
{
    use \Uiza\ApiOperation\Request;
    /**
     * @return ApiResource The refreshed resource.
     */
    public function refresh()
    {
        $url = static::resourceUrl();
        $params = [
            'id' => $this['id'],
            'appId' => \Uiza\Base::$appId
        ];
        $response = static::_staticRequest('GET', $url, $params);
        $this->setLastResponse($response);
        $this->refreshFrom($response->body);

        return $this;
    }
}
