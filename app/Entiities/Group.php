<?php namespace App\Entiities;


use App\Auth\User;

class Group extends Entity
{
    /**
     * 定义和用户表的关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id');
    }
}