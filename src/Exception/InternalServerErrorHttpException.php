<?php

namespace Exception;


class InternalServerErrorHttpException extends HttpException
{
    /**
     * InternalServerErrorHttpException constructor.
     * @param null|string $message
     */
    public function __construct($message = null)
    {
        parent::__construct(500, $message);
    }
}