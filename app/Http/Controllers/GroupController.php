<?php

namespace App\Http\Controllers;

use App\Entiities\Group;
use App\Entiities\GroupRepo;
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
        return view('group.group-form');
    }

    public function storeGroup(Request $request)
    {
        $request->validate([
            'name' => "required|string"
        ]);

        $this->groupRepo->create($request->all());

        return redirect('/group');
    }
}
