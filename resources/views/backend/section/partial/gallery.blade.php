<li class="nav-item {{ request()->routeIs('galleries.*')  ? 'active' : '' }}">
    <a href="{{route('galleries.index') }}" class="nav-link">
        <i class="link-icon" data-feather="image"></i>
        <span class="link-title">Gallery Section</span>
    </a>
</li>
