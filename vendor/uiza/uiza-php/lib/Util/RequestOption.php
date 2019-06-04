<?php

namespace Uiza\Util;

class RequestOptions
{
	/**
     * Unpacks an options array into an RequestOptions object
     * @param array|string|null $options a key => value array
     *
     * @return RequestOptions
     */
    public static function parse($options)
    {
        if ($options instanceof self) {
            return $options;
        }
        if (is_null($options)) {
            return new RequestOptions(null, [], null);
        }
        if (is_string($options)) {
            return new RequestOptions($options, [], null);
        }
        if (is_array($options)) {
            $headers = [];
            $key = null;
            $base = null;
            if (array_key_exists('api_key', $options)) {
                $key = $options['api_key'];
            }

            if (array_key_exists('api_base', $options)) {
                $base = $options['api_base'];
            }

            return new RequestOptions($key, $headers, $base);
        }

        $message = 'The second argument to Stripe API method calls is an '
           . 'optional per-request apiKey, which must be a string, or '
           . 'per-request options, which must be an array. (HINT: you can set '
           . 'a global apiKey by "Stripe::setApiKey(<apiKey>)")';

        throw new Error\Api($message);
    }
}