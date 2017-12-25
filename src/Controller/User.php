<?php

namespace Controller;


class User
{
    public function listAction()
    {
        return [
            'list' => [
                ['id' => 1, 'username' => 'admin'],
                ['id' => 2, 'username' => 'user'],
                ['id' => 3, 'username' => 'guest'],
            ]
        ];
    }

    public function getUserByIdAction($test, $id)
    {
        return [
            'id' => 1, 'username' => 'admin'
        ];
    }
}
