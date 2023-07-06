
<li class="nav-item {{ request()->routeIs('users.*')  ? 'active' : '' }}">
    <a href="{{route('users.index') }}" class="nav-link {{request()->routeIs('users.*') ? 'active' : ''}}">
        <i class="link-icon" data-feather="users"></i>
        <span class="link-title">User Management</span>
    </a>
</li>





