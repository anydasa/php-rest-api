<?php

namespace Rest;


class Response
{
    public function send($code, $data = [])
    {
        http_response_code($code);
        echo json_encode($data);
    }
}
