<?php

namespace Config\File;


use Config\ConfigInterface;

class Json implements ConfigInterface
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function toArray()
    {
        $content = file_get_contents($this->file);

        return json_decode($content, true);
    }
}
