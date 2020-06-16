<?php

namespace App\Http\Controllers;

use App\Entities\Repo\ModuleRepo;
use Illuminate\Http\Request;
use App\Entities\Project;

class ModuleController extends Controller
{
    protected $moduleRepo;

    /**
     * ModuleController constructor.
     * @param ModuleRepo $moduleRepo
     */
    public function __construct(ModuleRepo $moduleRepo)
    {
        $this->moduleRepo = $moduleRepo;
    }

    /**
     * 显示module信息
     * @param string|null $moduleSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \App\Exceptions\NotFoundException
     */
    public function show($projectSlug, string $moduleSlug = null)
    {
        $module = $this->moduleRepo->getBySlug($moduleSlug);
        $project = $module->project;
        $group = $project->group;
        $modules = $project->modules;

        return view('project.interface-api.interface-api', [
            'group' => $group,
            'project' => $project,
            'modules' => $modules,
            'current_module' => $module
        ]);
    }

    /**
     * 向数据库中插入一条module信息
     * @param Request $request
     * @param $projectSlug
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, $projectSlug)
    {
        $request->validate([
            'name' => 'required|string|max:20'
        ]);

        $this->moduleRepo->create($request->all(), $projectSlug);
        $this->showSuccessNotification('保存成功');

        $project = Project::where('slug', '=', $projectSlug)->first();
        return redirect($project->getUrl('interface'));
    }
}
