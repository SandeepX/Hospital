<li class="nav-item  {{
                       request()->routeIs('doctors.*') ||
                       request()->routeIs('doctor-schedules.*') ||
                       request()->routeIs('doctors-position.*')
                       ? 'active' : ''  }} ">

{{--    {{dd(request()->routeIs('doctors-position.*'))}}--}}

    <a class="nav-link" data-bs-toggle="collapse" href="#doctor_section" role="button" aria-expanded="false" aria-controls="company">
        <i class="link-icon" data-feather="database"></i>
        <span class="link-title">Doctor Section</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>

    <div id="doctor_section" class="{{
                    request()->routeIs('doctors.*') ||
                     request()->routeIs('doctors-position.*') ||
                      request()->routeIs('doctor-schedules.*')
                   ? '' : 'collapse'  }} "  >

        <ul class="nav sub-menu">
            <li class="nav-item">
                <a href="{{route('doctors.index')}}" class="nav-link {{request()->routeIs('doctors.*') ? 'active' : ''}}">Doctor List</a>
            </li>
            <li class="nav-item">
                <a href="{{route('doctor-schedules.index')}}" class="nav-link {{request()->routeIs('doctor-schedules.*') ? 'active' : ''}}">Doctor Schedule</a>
            </li>
            <li class="nav-item">
                <a href="{{route('doctors-position.index')}}" class="nav-link {{ request()->routeIs('doctors-position.index') ? 'active' : '' }}">Doctor Position</a>
            </li>

        </ul>
    </div>
</li>

