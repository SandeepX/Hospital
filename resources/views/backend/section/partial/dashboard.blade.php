
<li class="nav-item {{request()->routeIs('admin')  ? 'active' : '' }} " >
    <a href="{{route('admin')}}" class="nav-link">
        <i class="link-icon" data-feather="box"></i>
        <span class="link-title">Dashboard</span>
    </a>
</li>
