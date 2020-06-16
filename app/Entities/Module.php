<?php namespace App\Entities;

class Module extends Entity
{
    protected $fillable = ['project_id', 'name', 'introduction'];

    /**
     * Module constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * 定义和project的模型关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Entities\Project');
    }

    /**
     * 获取Module的链接地址
     * @param bool $path
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUrl($path = false)
    {
        $project = $this->project;

        if ($path !== false) {
            return url('/project/' .$project->slug. '/interface' . '/module/' . urlencode($this->slug) . '/' . trim($path, '/'));
        }

        return url('/project/' .$project->slug . '/interface' . '/module/' . urlencode($this->slug));
    }
}