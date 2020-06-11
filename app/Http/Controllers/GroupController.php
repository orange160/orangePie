<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    //

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
        return redirect('/gorup');
    }
}
