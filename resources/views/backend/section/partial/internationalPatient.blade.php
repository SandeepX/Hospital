
<li class="nav-item {{ request()->routeIs('international-patients.*')  ? 'active' : '' }}">
    <a href="{{route('international-patients.index') }}" class="nav-link">
        <i class="link-icon" data-feather="users"></i>
        <span class="link-title">International Patients</span>
    </a>
</li>
