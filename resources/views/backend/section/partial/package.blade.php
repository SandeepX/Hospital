
<li class="nav-item {{ request()->routeIs('hospital-packages.*')  ? 'active' : '' }}">
    <a href="{{route('hospital-packages.index') }}" class="nav-link">
        <i class="link-icon" data-feather="heart"></i>
        <span class="link-title">Package Section</span>
    </a>
</li>


