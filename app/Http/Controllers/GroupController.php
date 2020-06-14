<?php

namespace App\Http\Controllers;

use App\Entities\Group;
use App\Entities\Repo\GroupRepo;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    protected $groupRepo;

    /**
     * GroupController constructor.
     * @param GroupRepo $groupRepo
     */
    public function __construct(GroupRepo $groupRepo)
    {
        $this->groupRepo = $groupRepo;
    }

    /**
     * 获取创建group的表单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getGroupForm()
    {
        return view('group.group-create', ['groups' => user()->groups]);
    }

    /**
     * 向数据库中插入一条group数据
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeGroup(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:16"
        ]);

        if ($this->groupRepo->create($request->all())) {
            $this->showSuccessNotification('保存成功');
        }

        return redirect('/group');
    }

    /**
     * 通过slug搜索group并显示
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \App\Exceptions\NotFoundException
     */
    public function show($slug)
    {
        $groupDetail = $this->groupRepo->getBySlug($slug);
        return view('group.group', ['groups' => user()->groups, 'groupDetail' => $groupDetail]);
    }
}
