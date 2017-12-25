<?php

namespace Exception;


class NotFoundHttpException extends HttpException
{
    public function __construct($message = null)
    {
        parent::__construct(404, $message);
    }
}
