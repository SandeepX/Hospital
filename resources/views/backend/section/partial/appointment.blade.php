
<li class="nav-item {{ request()->routeIs('appointments.*')  ? 'active' : '' }}">
    <a href="{{route('appointments.index') }}" class="nav-link">
        <i class="link-icon" data-feather="book-open"></i>
        <span class="link-title">Appointment Section</span>
    </a>
</li>


