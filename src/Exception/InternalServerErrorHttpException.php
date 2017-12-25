<?php

namespace Exception;


class InternalServerErrorHttpException extends HttpException
{
    public function __construct($message = null)
    {
        parent::__construct(500, $message);
    }
}