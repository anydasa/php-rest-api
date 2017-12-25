<?php

namespace Rest;


class Response
{
    public function setStatus($code) {
        http_response_code($code);
    }

    public function send($data = [])
    {
        echo json_encode($data);
    }
}
