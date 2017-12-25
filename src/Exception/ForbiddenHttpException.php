<?php

namespace Exception;


class ForbiddenHttpException extends HttpException
{
    public function __construct($message = null)
    {
        parent::__construct(403, $message);
    }
}