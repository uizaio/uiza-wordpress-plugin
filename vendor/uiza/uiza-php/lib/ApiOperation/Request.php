<?php

namespace Uiza\ApiOperation;
use Uiza\Exception\InvalidParam;
use \Curl\Curl;

trait Request {

    /**
     * @param array|null|mixed $params The list of parameters to validate
     *
     * @throws \Stripe\Error\Api if $params exists and is not an array
     */
    protected static function _validateParams($action, $params = [])
    {
        if ($params && !is_array($params)) {
            $message = "You must pass an array as the first argument.";
            throw new InvalidParam($message);
        }
        if (method_exists(get_called_class(), 'validate'.$action)) {
            static::{'validate'.$action}($params);
        }
    }

    /**
     * @param string $method HTTP method ('get', 'post', etc.)
     * @param string $url URL for the request
     * @param array $params list of parameters for the request
     * @param array|string|null $options
     *
     * @return array tuple containing (the JSON response, $options)
     */
    protected static function _staticRequest($method, $url, $params, $options = null)
    {
        $headers = [];
        if ($options && isset($options['hearders'])) {
            $headers = $options['hearders'];
        }

        $requestor = new \Uiza\ApiRequestor();
        $response = $requestor->request($method, $url, $params, $headers);

        return $response;
    }
}
