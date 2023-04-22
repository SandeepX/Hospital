<li class="nav-item {{ request()->routeIs('team.*') ? 'active' : ''  }} ">
    <a href="{{route('team.index')}}" class="nav-link {{request()->routeIs('team.*') ? 'active' : ''}} ">
        <i class="link-icon" data-feather="user"></i>
        <span class="link-title">Team Member</span>
    </a>
</li>
