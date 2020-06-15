
<div>
    <h5 class="m-0 p-3 bg-secondary text-white border-bottom">
        <a class="text-white" href="{{ $project->group->getUrl() }}">{{ $project->group->name }}</a>
        /
        <a class="text-white" href="{{ $project->getUrl() }}">{{ $project->name }}</a>
    </h5>

    <div class="bg-secondary">
        <div class="p-2 row justify-content-between">
            <div class="col-8">@include('form.text', ['name' => 'searchContent', 'placeholder' => '搜索接口'])</div>
            <div class="col-4"><a class="btn btn-outline-light" href="">创建模块</a></div>
        </div>
    </div>

    <div class="bg-white">
        this is api modules
    </div>
</div>
