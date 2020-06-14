<?php

namespace App\Http\Controllers;

use App\Entities\Group;
use App\Entities\Repo\ProjectRepo;
use Illuminate\Http\Request;

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
}
