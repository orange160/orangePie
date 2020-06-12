<?php namespace App\Entiities;


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

    public function getUrl($path = false)
    {
        if ($path !== false) {
            return url('/group/' . urlencode($this->slug) . '/' . trim($path, '/'));
        }

        return url('/group/' . urlencode($this->slug));
    }
}