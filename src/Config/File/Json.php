<?php

namespace Config\File;


use Config\ConfigInterface;

class Json implements ConfigInterface
{
    /** @var string */
    private $file;

    /**
     * Json constructor.
     * @param string $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $content = file_get_contents($this->file);

        return json_decode($content, true);
    }
}
