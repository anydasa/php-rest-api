<?php

namespace Exception;


class UnauthorizedHttpException extends HttpException
{
    public function __construct($message = null)
    {
        parent::__construct(401, $message);
    }
}
