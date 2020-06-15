<a href="{{ $group->getUrl() }}"
   class="group entity-list-item @if(request()->slug === $group->slug) active-list-item @endif"
   data-entity-type="group"
   data-entity-id="{{ $group->id }}"
>
    <div>@icon('group')</div>
    <div class="group-name pl-2">
        {{ $group->name }}
    </div>
</a>
