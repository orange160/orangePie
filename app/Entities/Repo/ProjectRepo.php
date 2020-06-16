<?php namespace App\Entities\Repo;

use App\Entities\Project;

class ProjectRepo
{
    protected $project;

    /**
     * ProjectRepo constructor.
     * @param Project $project
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function create($data, $group)
    {
        $this->project->fill([
            'name' => $data['name'],
            'group_id' => $group->id,
            'introduction' => $data['introduction']
        ]);
        $this->project->refreshSlug();

        return $this->project->save();
    }
}