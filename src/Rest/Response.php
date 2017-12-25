<?php

namespace Rest;


class Response
{
    public function send($code, $data = [], $headers = [])
    {
        http_response_code($code);

        foreach ($headers as $key => $value) {
            header(sprintf('%s: %s', $key, $value));
        }

        header('Content-Type: application/json');

        echo json_encode($data);
    }
}
