<?php

namespace Exception;


class ForbiddenHttpException extends HttpException
{
    /**
     * ForbiddenHttpException constructor.
     * @param null|string $message
     */
    public function __construct($message = null)
    {
        parent::__construct(403, $message);
    }
}