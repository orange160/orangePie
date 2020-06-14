@extends('home.home')

@section('main-content')
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="group-project-tab" data-toggle="tab" href="#group-project" role="tab">项目列表</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="group-member-tab" data-toggle="tab" href="#group-member" role="tab">成员列表</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="group-activity-tab" data-toggle="tab" href="#group-activity" role="tab">分组动态</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="group-settings-tab" data-toggle="tab" href="#group-settings" role="tab">分组设置</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane fade show active" id="group-project" role="tabpanel" aria-labelledby="group-project-tab">
            @includeIf('group.projects', ['group' => $groupDetail])
        </div>
        <div class="tab-pane fade" id="group-member" role="tabpanel" aria-labelledby="group-member=tab">456</div>
        <div class="tab-pane fade" id="group-activity" role="tabpanel" aria-labelledby="group-activity-tab">789</div>
        <div class="tab-pane fade" id="group-settings" role="tabpanel" aria-labelledby="group-settings-tab">234</div>
    </div>
@endsection