<?php namespace App\Entities;


use App\Auth\User;

class Group extends Entity
{

    protected  $fillable = ['name', 'introduction'];
    /**
     * 定义和用户表的关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id');
    }

    /**
     * 定义和project的模型关联
     */
    public function projects()
    {
        return $this->hasMany('App\Entities\Project');
    }

    /**
     * 获取group的链接地址
     * @param bool $path
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrl($path = false)
    {
        if ($path !== false) {
            return url('/group/' . urlencode($this->slug) . '/' . trim($path, '/'));
        }

        return url('/group/' . urlencode($this->slug));
    }
}