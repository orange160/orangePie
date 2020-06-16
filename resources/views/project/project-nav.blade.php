
<ul class="nav nav-pills justify-content-start bg-white px-4">

    <li class="nav-item">
        <a class="nav-link @if(Str::of(request()->fullUrl())->contains('interface')) active @endif"
           href="{{ $project->getUrl('interface') }}"
        >
            接口
        </a>
    </li>

    <li class="nav-item">

        <a class="nav-link @if(Str::of(request()->fullUrl())->contains('activity')) active @endif"
           href="{{ $project->getUrl('activity') }}"
        >
            动态
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if(Str::of(request()->fullUrl())->contains('member')) active @endif"
           href="{{ $project->getUrl('member') }}"
        >
            成员管理
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link @if(Str::of(request()->fullUrl())->contains('settings')) active @endif"
           href="{{ $project->getUrl('settings') }}"
        >
            设置
        </a>
    </li>
</ul>

