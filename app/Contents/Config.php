<?php
declare(strict_types=1);

namespace App\Contents;

abstract class Config
{
    public static function rootDirectory()
    {
        return base_path(env('APP_MDPAGES_PATH'));
    }
}