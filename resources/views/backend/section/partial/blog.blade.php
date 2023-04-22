<li class="nav-item {{ request()->routeIs('blogs.*')  ? 'active' : '' }}">
    <a href="{{route('blogs.index') }}" class="nav-link">
        <i class="link-icon" data-feather="calendar"></i>
        <span class="link-title">Blog Section</span>
    </a>
</li>
