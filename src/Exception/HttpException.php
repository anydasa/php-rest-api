<?php

namespace Exception;

use Exception;

class HttpException extends Exception {

    /** @var int */
    private $statusCode;

    /** @var array  */
    private $headers;

    /**
     * HttpException constructor.
     * @param $statusCode
     * @param null|string $message
     * @param array $headers
     */
    public function __construct($statusCode, $message = null, array $headers = [])
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;

        parent::__construct($message);
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }
}