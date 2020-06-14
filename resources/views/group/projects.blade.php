<div class="p-2 bg-secondary text-white mt-2 row align-items-center justify-content-between px-3">
    <span>
        {{ Str::limit($group->name, 40) }} 分组有({{ count($group->projects) }})个项目
    </span>
    <a class="btn btn-sm btn-primary" href="{{ url($group->getUrl() . '/' . 'create-project') }}">创建项目</a>
</div>

<div class="entity-grid-auto mt-3">
    @if (count($group->projects) > 0)
        @foreach($group->projects as $project)
            @include('project.list-item', ['project' => $project])
        @endforeach
    @endif
</div>