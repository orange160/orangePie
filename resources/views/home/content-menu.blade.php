<div class="content-menu">
    <div class="bg-white p-4 border-bottom">

        <div class="row justify-content-between px-3">
            <h5>
                @if(@isset($groupDetail))
                    {{ $groupDetail->name }}
                @else
                    @if(count($groups) > 0){{ $groups[0]->name }}@endif
                @endif
            </h5>
            <a href={{ url("/group") }}>{{ __('common.create') }}</a>
        </div>

        <div class="text-small text-muted my-3">{{ __('common.introduction') }}:
            @if(@isset($groupDetail))
                {{ $groupDetail->introduction }}
            @else
                @if(count($groups) > 0){{ $groups[0]->introduction }}@endif
            @endif
        </div>

        @include('form.text', ['name' => 'searchContent', 'placeholder' => '搜索'])
    </div>

    <div class="bg-white py-3">
    @if(count($groups) > 0)
            <div class="entity-list group">
                @foreach($groups as $group)
                    @include('group.list-item', ['group' => $group])
                @endforeach
            </div>
    @endif
    </div>
</div>