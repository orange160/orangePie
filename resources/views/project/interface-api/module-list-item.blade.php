
<a href="{{ $module->getUrl() }}"
   class="entity-list-item @if(request()->moduleSlug === $module->slug) active-list-item active-collapse-item @endif"
>
    <span class="arrow">@icon('triangle-right')</span>
    <span class="module-name">{{ $module->name }}</span>
</a>
