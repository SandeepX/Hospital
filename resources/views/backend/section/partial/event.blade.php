<li class="nav-item {{ request()->routeIs('events.*')  ? 'active' : '' }}">
    <a href="{{route('events.index') }}" class="nav-link">
        <i class="link-icon" data-feather="gift"></i>
        <span class="link-title">Event Management</span>
    </a>
</li>
