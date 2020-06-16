<?php namespace App\Entities\Repo;


use App\Entities\Module;
use App\Entities\Project;
use App\Exceptions\NotFoundException;

class ModuleRepo
{
    protected $module;

    /**
     * ModuleRepo constructor.
     * @param Module $module
     */
    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    /**
     * 将一条module数据插入数据库
     * @param $data
     * @param $projectSlug
     * @return bool
     */
    public function create($data, $projectSlug)
    {
        $project = null;
        if ($projectSlug !== null) {
            $project = Project::where('slug', '=', $projectSlug)->first();
        }
        if ($project === null) return false;

        $this->module->fill([
            'name' => $data['name'],
            'introduction' => $data['introduction'],
            'project_id' => $project->id,
        ]);
        $this->module->refreshSlug();
        return $this->module->save();
    }

    public function getBySlug(string $slug = null)
    {
        $module = Module::where('slug', '=', $slug)->first();
        if ($module === null) {
            throw new NotFoundException(trans('module.module_not_found'));
        }

        return $module;
    }
}