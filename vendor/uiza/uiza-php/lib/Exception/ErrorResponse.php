<?php

namespace Uiza\Exception;

class ErrorResponse extends Base
{
     public function __construct(
        $statusCode,
        $reasonPhrase,
        $message,
        $httpStatus = null,
        $httpBody = null,
        $jsonBody = null,
        $httpHeaders = null
    ) {
        parent::__construct($message, $httpStatus, $httpBody, $jsonBody, $httpHeaders);
        $this->statusCode = $statusCode;
        $this->reasonPhrase = $reasonPhrase;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getReasonPhrase()
    {
        return $this->reasonPhrase;
    }

    public function __toString()
    {
        $message = explode("\n", parent::__toString());
        $error = "Error : {$this->getStatusCode()} {$this->getReasonPhrase()}";
        array_unshift($message, $error);

        return implode("\n", $message);
    }
}
