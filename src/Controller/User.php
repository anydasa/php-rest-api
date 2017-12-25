<?php

namespace Controller;

class User
{
    private $list = [
        ['id' => 1, 'username' => 'admin'],
        ['id' => 2, 'username' => 'user'],
        ['id' => 3, 'username' => 'guest'],
    ];

    public function listAction()
    {
        return [
            'list' => $this->list
        ];
    }

    public function getUserByIdAction($id)
    {
        $filtered = array_filter($this->list, function ($item) use ($id){
            return $item['id'] == $id;
        });
        
        return count($filtered) > 0 ? current($filtered) : [];
    }
}
