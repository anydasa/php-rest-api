<?php

namespace Exception;


class UnauthorizedHttpException extends HttpException
{
    /**
     * UnauthorizedHttpException constructor.
     * @param null|string $message
     */
    public function __construct($message = null)
    {
        parent::__construct(401, $message);
    }
}
