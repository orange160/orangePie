<?php namespace App\Entities;


use App\Entities\Entity;

class Project extends Entity
{
    protected $fillable = ['name', 'group_id', 'introduction'];

    /**
     * 定义和group的模型关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo('App\Entities\Group');
    }

    /**
     * 定义和module的模型关联
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modules()
    {
        return $this->hasMany('App\Entities\Module');
    }

    /**
     * 获取Project的链接地址
     * @param bool $path
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrl($path = false)
    {
        if ($path !== false) {
            return url('/project/' . urlencode($this->slug) . '/' . trim($path, '/'));
        }

        return url('/project/' . urlencode($this->slug));
    }
}