<?php

use Illuminate\Support\Facades\Log;

/**
 * 文件说明:
 * helper文件在composer.json中配置的自动加载,
 * 然后执行 composer dump-autoload
 */

function my_log($message)
{
    Log::debug($message);
}
