<?php

namespace App\Http\Controllers;

use App\Entities\Module;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
    }

    public function create(string $projectSlug, string $moduleSlug = null)
    {
        $current_module = Module::where('slug', '=', $moduleSlug)->first();
        $project = $current_module->project;
        $group = $project->group;
        $modules = $project->modules;
        return view('apis.api-create', [
            'group' => $group,
            'project' => $project,
            'modules' => $modules,
            'current_module' => $current_module
            ]);
    }
}
