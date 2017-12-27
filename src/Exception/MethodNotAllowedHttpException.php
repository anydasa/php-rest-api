<?php

namespace Exception;


class MethodNotAllowedHttpException extends HttpException
{
    /**
     * MethodNotAllowedHttpException constructor.
     * @param array $allow
     * @param null|string $message
     */
    public function __construct(array $allow, $message = null)
    {
        $headers = array('Allow' => strtoupper(implode(', ', $allow)));

        parent::__construct(405, $message, $headers);
    }
}
