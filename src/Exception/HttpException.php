<?php

namespace Exception;

use Exception;

class HttpException extends Exception {

    public function __construct($code, $message = null) {
        parent::__construct($message, $code);
    }
}