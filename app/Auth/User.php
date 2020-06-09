<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * This holds the default user when loaded
     * @var null|User
     */
    protected static $defaultUser = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check if the user is the default public user
     *
     * @return bool
     */
    public function isDefault()
    {
        return $this->system_name === 'public';
    }

    public static function getDefault()
    {
        if (!is_null(static::$defaultUser)) {
            return static::$defaultUser;
        }

        static::$defaultUser = static::where('system_name', '=', 'public')->first();
        return static::$defaultUser;
    }
}
