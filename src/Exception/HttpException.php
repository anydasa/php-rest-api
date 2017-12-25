<?php

namespace Exception;

use Exception;

class HttpException extends Exception {

    private $statusCode;
    private $headers;

    public function __construct($statusCode, $message = null, array $headers = array())
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;

        parent::__construct($message);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getHeaders()
    {
        return $this->headers;
    }


    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }
}