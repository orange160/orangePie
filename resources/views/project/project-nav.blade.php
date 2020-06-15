
<ul class="nav nav-pills justify-content-start bg-white px-4">

    <li class="nav-item">
        <a class="nav-link @if(Str::of(request()->fullUrl())->endsWith('interface')) active @endif"
           href="{{ $project->getUrl('interface') }}"
        >
            接口
        </a>
    </li>

    <li class="nav-item">

        <a class="nav-link @if(Str::of(request()->fullUrl())->endsWith('activity')) active @endif"
           href="{{ $project->getUrl('activity') }}"
        >
            动态
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if(Str::of(request()->fullUrl())->endsWith('member')) active @endif"
           href="{{ $project->getUrl('member') }}"
        >
            成员管理
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if(Str::of(request()->fullUrl())->endsWith('settings')) active @endif"
           href="{{ $project->getUrl('settings') }}"
        >
            设置
        </a>
    </li>
</ul>

