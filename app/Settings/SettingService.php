<?php
namespace App\Settings;


use Illuminate\Contracts\Cache\Repository as Cache;

/**
 * Class SettingService
 * The settings are a simple key-value database store.
 * For non-authenticated users, user settings are stored via the session instead.
 */
class SettingService
{
    protected $setting;
    protected $cache;
    protected $localCache = [];

    protected $cachePrefix = 'setting-';

    /**
     * SettingService constructor.
     * @param Setting $setting
     * @param Cache $cache
     */
    public function __construct(Setting $setting, Cache $cache)
    {
        $this->$setting = $setting;
        $this->cache = $cache;
    }

    /**
     * Get a setting from the database,
     * If not found, Returns default, Which is false by default
     *
     * @param $key
     * @param string|bool $default
     * @return bool|mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function get($key, $default = false)
    {
        if ($default === false) {
            $default = config('setting-defaults.' . $key, false);
        }

        if (isset($this->localCache[$key])) {
            return $this->localCache[$key];
        }

        $value = $this->getValueFromStore($key, $default);
        $formatted = $this->formatValue($value, $default);
        $this->localCache[$key] = $formatted;
        return $formatted;
    }

    /**
     * Get a setting value from the cache or database
     * Looks at the system defaults if not cached or in database
     *
     * @param $key
     * @param $default
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function getValueFromStore($key, $default)
    {
        // Check the cache
        $cacheKey = $this->cachePrefix . $key;
        $cacheVal = $this->cache->get($cacheKey, null);
        if ($cacheVal !== null) {
            return $cacheVal;
        }

        // Check the database
        $settingObject = $this->getSettingObjectByKey($key);
        if ($settingObject !== null) {
            $value = $settingObject->value;
            $this->cache->forever($cacheKey, $value);
            return $value;
        }
    }


    protected function formatValue($value, $default)
    {
        // Change string booleans to actual booleans
        if ($value === 'true') {
            $value = true;
        }
        if ($value === 'false') {
            $value = false;
        }

        // Set to default if empty
        if ($value === '') {
            $value = $default;
        }

        return $default;
    }

    /**
     * Get a setting model from the database for the given key.
     * @param $key
     * @return mixed
     */
    protected function getSettingObjectByKey($key)
    {
        return $this->setting->where('setting_key', '=', $key)->first();
    }
}