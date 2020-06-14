<?php

namespace App\Auth;

use App\Entities\Group;
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

    /**
     * Get the groups in this user
     * Should not be used directly since does not take into account permission
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        // 定义模型关联
        // 多对多的模型关联，使用的都是belongsToMany。没有hasMany和hasOne
        // belongsToMany: 定义一个多对多的关联。user_id代表此模型在关联表里的外键名，group_id是另一个模型在关联表里的外键名
        // withPivot: pivot 对象只包含两个关联模型的主键，如果你的中间表里还有其他额外字段，你必须在定义关联时明确指出：withPivot('order')
        // order列只在User中使用，所以在此模型中使用了withPivot('order')，book模型中不使用.
        return $this->belongsToMany(Group::class, 'group_user', 'user_id', 'group_id')
            ->withPivot('order')
            ->orderBy('order', 'desc');
    }
}
