<?php

namespace App\Http\Controllers;

use App\Entities\Group;
use App\Entities\Repo\ProjectRepo;
use Illuminate\Http\Request;
use App\Entities\Project;

class ProjectController extends Controller
{
    protected $projectRepo;

    /**
     * ProjectController constructor.
     * @param ProjectRepo $projectRepo
     */
    public function __construct(ProjectRepo $projectRepo)
    {
        $this->projectRepo = $projectRepo;
    }

    /**
     * 获取创建project的表单
     * @param string|null $groupSlug
     * @return string
     */
    public function create(string $groupSlug = null)
    {
        $group = $this->getGroupBySlug($groupSlug);

        return view('project.project-create', ['group' => $group]);
    }

    /**
     * 向数据库中插入一条项目数据
     * @param Request $request
     * @param string|null $groupSlug
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, string $groupSlug = null)
    {
        $request->validate([
            'name' => 'string|required'
        ]);

        $group = $this->getGroupBySlug($groupSlug);
        $this->projectRepo->create($request->all(), $group);

        return redirect('/group/' . $groupSlug);
    }

    /**
     * 根据group的slug获取group对象
     *
     * @param $groupSlug
     * @return Group|null
     */
    protected function getGroupBySlug($groupSlug)
    {
        $group = null;
        if ($groupSlug !== null) {
            $group = Group::where('slug', '=', $groupSlug)->first();
        }
        return $group;
    }

    /**
     * 根据project的slug获取project对象
     * @param $projectSlug
     * @return Project|null
     */
    protected function getProjectBySlug($projectSlug)
    {
        $project = null;
        if ($projectSlug !== null) {
            $project = Project::where('slug', '=', $projectSlug)->first();
        }
        return $project;
    }

    /**
     * 显示Project的信息
     * @param string|null $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $slug = null)
    {
        $project = null;
        if ($slug !== null) {
            $project = $this->getProjectBySlug($slug);
        }
        return view('project.show', ['project' => $project]);
    }

    /**
     * project的接口页面
     * @param string|null $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showInterface(string $slug = null)
    {
        $project = null;
        if ($slug !== null) {
            $project = $this->getProjectBySlug($slug);
        }
        return view('project.project-interface', ['group' => $project->group, 'project' => $project, 'modules' => $project->modules]);
    }

    /**
     * project的activity记录
     * @param string|null $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showActivity(string $slug = null)
    {
        $project = null;
        if ($slug !== null) {
            $project = $this->getProjectBySlug($slug);
        }

        return view('project.project-activity', ['project' => $project]);
    }

    /**
     * project的成员
     * @param string|null $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMember(string $slug = null)
    {
        $project = null;
        if ($slug !== null) {
            $project = $this->getProjectBySlug($slug);
        }

        return view('project.project-member', ['project' => $project]);
    }

    /**
     * project的设置界面
     * @param string|null $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSettings(string $slug = null)
    {
        $project = null;
        if ($slug !== null) {
            $project = $this->getProjectBySlug($slug);
        }

        return view('project.project-settings', ['project' => $project]);
    }

}
