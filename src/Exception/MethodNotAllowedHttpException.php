<?php

namespace Exception;


class MethodNotAllowedHttpException extends HttpException
{
    public function __construct(array $allow, $message = null)
    {
        $headers = array('Allow' => strtoupper(implode(', ', $allow)));

        parent::__construct(405, $message, $headers);
    }
}
