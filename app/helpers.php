<?php

use App\Auth\User;
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


/**
 * Get fetch an SVG icon as a string.
 * Checks for icons defined within a custom theme before defaulting back
 * to the 'resources/assets/icons' folder.
 *
 * Returns an empty string if icon file not found.
 * @param $name
 * @param array $attrs
 * @return mixed
 */
function icon(string $name, array $attrs = []): string
{
    $attrs = array_merge([
        'class'     => 'svg-icon',
        'data-icon' => $name,
        'role'      => 'presentation',
    ], $attrs);
    $attrString = ' ';
    foreach ($attrs as $attrName => $attr) {
        $attrString .=  $attrName . '="' . $attr . '" ';
    }

    $iconPath = resource_path('icons/' . $name . '.svg');
    $themeIconPath = theme_path('icons/' . $name . '.svg');
    if ($themeIconPath && file_exists($themeIconPath)) {
        $iconPath = $themeIconPath;
    } else if (!file_exists($iconPath)) {
        return '';
    }

    $fileContents = file_get_contents($iconPath);
    return  str_replace('<svg', '<svg' . $attrString, $fileContents);
}

/**
 * Get a path to a theme resource.
 * @param string $path
 * @return string
 */
function theme_path(string $path = ''): string
{
    $theme = config('view.theme');
    if (!$theme) {
        return '';
    }

    return base_path('themes/' . $theme .($path ? DIRECTORY_SEPARATOR.$path : $path));
}

/**
 * @return \Illuminate\Contracts\Auth\Authenticatable
 */
function user(): \Illuminate\Contracts\Auth\Authenticatable
{
    return auth()->user() ?: User::getDefault();
}

/**
 * Helper to access system settings.
 * @param string|null $key
 * @param bool $default
 * @return mixed
 */
function setting(string $key = null, $default = false)
{
    $settingService = resolve(\App\Settings\SettingService::class);
    if (!is_null($key)) {
        return $settingService;
    }
    return $settingService->get($key, $default);
}
