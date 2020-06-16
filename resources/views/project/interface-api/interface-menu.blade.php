
<div>
    <h5 class="m-0 p-3 bg-secondary text-white border-bottom">
        <a class="text-white" href="{{ $group->getUrl() }}">{{ $group->name }}</a>
        /
        <a class="text-white" href="{{ $project->getUrl() }}">{{ $project->name }}</a>
    </h5>

    <div class="bg-secondary">
        <div class="p-2 row justify-content-between">
            <div class="col-8">@include('form.text', ['name' => 'searchContent', 'placeholder' => '搜索接口'])</div>
            <div class="col-4"><button class="btn btn-outline-light" data-toggle="modal" data-target="#createModuleModal">创建模块</button></div>
        </div>
    </div>

    <div class="entity-list bg-white">
        @foreach($modules as $module)
            @include('project.interface-api.module-list-item', ['module' => $module])
        @endforeach
    </div>

    <!--------------------------------- 创建模块弹框 ------------------------------------>
    <div class="modal fade" id="createModuleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">创建模块</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ $project->getUrl('create-interface') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">模块名称</label>
                            @include('form.text', ['name' => 'name'])
                        </div>
                        <div class="form-group">
                            <label for="introduction">概要</label>
                            @include('form.textarea', ['name' => 'introduction'])
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('common.cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
