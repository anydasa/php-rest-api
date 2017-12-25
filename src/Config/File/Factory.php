<?php

namespace Config\File;

use InvalidArgumentException;
use DomainException;

class Factory
{
    public static function file($file, $type)
    {
        if (!is_file($file)) {
            throw new InvalidArgumentException(sprintf('The file %s not exists!', $file));
        }

        switch (strtoupper($type)) {
            case 'JSON':
                return new Json($file);
                break;
            default:
                throw new DomainException(sprintf('Not supported config type: %s', $type));
                break;

        }
    }
}
