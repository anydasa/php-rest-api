<?php

namespace Exception;


class NotFoundHttpException extends HttpException
{
    /**
     * NotFoundHttpException constructor.
     * @param null|string $message
     */
    public function __construct($message = null)
    {
        parent::__construct(404, $message);
    }
}
