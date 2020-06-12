<div class="content-menu">
    <div class="bg-white p-4 border-bottom">

        <div class="row justify-content-between px-3">
            <h5>CoCode开发组</h5>
            <a href={{ url("/group") }}>创建</a>
        </div>

        <div class="text-small text-muted my-3">简介: scs</div>

        @include('form.text', ['name' => 'searchContent', 'placeholder' => '搜索'])
    </div>

    <div class="bg-white py-3">
    @if(count($groups) > 0)
            <div class="entity-list">
                @foreach($groups as $group)
                    @include('group.list-item', ['group' => $group])
                @endforeach
            </div>
    @endif
    </div>
</div>