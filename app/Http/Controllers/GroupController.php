<?php

namespace App\Http\Controllers;

use App\Entiities\Group;
use App\Entiities\Repo\GroupRepo;
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
        return view('group.group-form', ['groups' => user()->groups]);
    }

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
}
