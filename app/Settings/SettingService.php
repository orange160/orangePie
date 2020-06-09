<?php
namespace App\Settings;


use App\Auth\User;
use Illuminate\Contracts\Cache\Repository as Cache;
use Psr\SimpleCache\InvalidArgumentException;

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
     * @throws InvalidArgumentException
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
     * Get a value from the session instead of the main store option
     *
     * @param $key
     * @param bool $default
     * @return mixed
     */
    protected function getFromSession($key, $default = false)
    {
        $value = session()->get($key, $default);
        return $this->formatValue($value, $default);
    }

    /**
     * @param User $user
     * @param $key
     * @param bool $default
     * @return bool|mixed
     * @throws InvalidArgumentException
     */
    public function getUser($user, $key, $default = false)
    {
        if ($user->isDefault()) {
            return $this->getFromSession($key, $default);
        }
        return $this->get($this->userKey($user->id, $key), $default);
    }

    /**
     * Get a value for the current logged-in user
     *
     * @param $key
     * @param bool $default
     * @return bool|mixed
     * @throws InvalidArgumentException
     */
    public function getForCurrentUser($key, $default = false)
    {
        return $this->getUser(user(), $key, $default);
    }

    /**
     * Convert a setting key into a user-specific key
     *
     * @param int $userId
     * @param string $key
     * @return string
     */
    protected function userKey($userId, $key = '')
    {
        return 'user:' . $userId . ':' . $key;
    }

    /**
     * Get a setting value from the cache or database
     * Looks at the system defaults if not cached or in database
     *
     * @param $key
     * @param $default
     * @return mixed
     * @throws InvalidArgumentException
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

    /**
     * Clear an item from the cache completely
     *
     * @param $key
     */
    protected function clearFromCache($key)
    {
        $cacheKey = $this->cachePrefix . $key;
        $this->cache->forget($key);
        if (isset($this->localCache[$key])) {
            unset($this->localCache[$key]);
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
     * Check if a setting exists
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        $setting = $this->getSettingObjectByKey($key);
        return $setting !== null;
    }

    /**
     * Check if a user setting is in the database
     * @param $key
     * @return bool
     */
    public function hasUser($key)
    {
        return $this->has($this->userKey($key));
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

    /**
     * Add a setting to database
     * @param $key
     * @param $value
     * @return bool
     */
    public function put($key, $value)
    {
        $setting = $this->setting->firstOrNew([
           'setting_key' => $key
        ]);
        $setting->value = $value;
        $setting->save();
        $this->clearFromCache($key);
        return true;
    }

    /**
     * Put a user specific setting into the database
     *
     * @param User $user
     * @param $key
     * @param $value
     * @return bool|void
     */
    public function putUser($user, $key, $value)
    {
        if ($user->isDefault()) {
            return session()->put($key, $value);
        }
        return $this->put($this->userKey($user->id, $key), $value);
    }

    /**
     * Remove a setting from the database
     *
     * @param $key
     * @return bool
     */
    public function remove($key)
    {
        $setting = $this->getSettingObjectByKey($key);
        if ($setting) {
            $setting->delete();
        }
        $this->clearFromCache($key);
        return true;
    }

    public function deleteUserSetting($userId) {
        return $this->setting->where('setting_key', 'like', $this->userKey($userId) . '%')->delete();
    }
}