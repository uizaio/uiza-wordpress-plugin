<?php

namespace Uiza\ApiOperation;

trait Delete {
	/**
     * @param array|null $params
     * @param array|string|null $opts
     *
     * @return \Uiza\ApiResource The deleted resource.
     */
    public static function delete($id, $params = [])
    {
        self::_validateParams('Delete', $params);
        $url = static::resourceUrl();
        $params = array_merge($params,[
            'id' => $id,
            'appId' => \Uiza\Base::$appId
        ]);
        $response = static::_staticRequest('DELETE', $url, $params);
        $instance = new static($id);
        $instance->refreshFrom($response->body);
        $instance->setLastResponse($response);

        return $instance;
    }

    public function destroy()
    {
        $params = $this->serializeParameters();
        $url = static::resourceUrl();
        $response = static::_staticRequest('DELETE', $url, $params);
        $this->refreshFrom($response->body);
        $this->setLastResponse($response);

        return $this;
    }
}
