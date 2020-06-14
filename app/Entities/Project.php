<?php namespace App\Entities;


use App\Entities\Entity;

class Project extends Entity
{
    protected $fillable = ['name', 'group_id', 'introduction'];

    /**
     * 定义和group的模型关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function group()
    {
        return $this->belongsToMany('App\Entities\Group');
    }
}