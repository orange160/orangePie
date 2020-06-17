<form class="api-form" action="" method="post">
  @csrf
    
    <div class="form-group">
        <label for="status">状态</label>
        <div class="display-a-row status">
            @include('form.radio', ['name' => 'status', 'description' => '已发布', 'id' => 'status-publish', 'bg' => 'bg-success'])

            @include('form.radio', ['name' => 'status', 'description' => '设计中', 'id' => 'status-design', 'bg' => 'bg-info'])
            @include('form.radio', ['name' => 'status', 'description' => '待确定', 'id' => 'status-not-sure', 'bg' => 'bg-info'])
            @include('form.radio', ['name' => 'status', 'description' => '开发', 'id' => 'status-dev', 'bg' => 'bg-info'])

            @include('form.radio', ['name' => 'status', 'description' => '异常', 'id' => 'status-abnormal', 'bg' => 'bg-danger'])
            @include('form.radio', ['name' => 'status', 'description' => '维护', 'id' => 'status-OM', 'bg' => 'bg-danger'])
            @include('form.radio', ['name' => 'status', 'description' => '废弃', 'id' => 'status-discard', 'bg' => 'bg-danger'])
        </div>
    </div>

    <div class="form-group">
        <label for="path">API Path</label>
        <div class="display-a-row path">
            <div>
                @include('form.select', ['name' => 'method',
                    'options' => [
                    ['value' => 'POST', 'description' => 'POST', 'selected' => 'true'],
                    ['value' => 'GET', 'description' => 'GET'],
                    ['value' => 'PUT', 'description' => 'PUT'],
                    ['value' => 'DELETE', 'description' => 'DELETE'],
                    ['value' => 'HEAD', 'description' => 'HEAD'],
                    ['value' => 'OPTIONS', 'description' => 'OPTIONS'],
                    ['value' => 'PATCH', 'description' => 'PATCH'],
                    ]])
            </div>
            <div>
                @include('form.text', ['name' => 'path', 'value' => '/'])
            </div>
        </div>
    </div>
    
</form>
