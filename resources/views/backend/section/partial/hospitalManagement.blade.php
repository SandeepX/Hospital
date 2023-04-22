<li class="nav-item  {{
                       request()->routeIs('hospital-profiles.*') ||
                       request()->routeIs('departmentsPosition')  ||
                       request()->routeIs('departments.*') ? 'active' : ''  }} ">

    <a class="nav-link" data-bs-toggle="collapse" href="#hospital_management" role="button" aria-expanded="false" aria-controls="company">
        <i class="link-icon" data-feather="align-justify"></i>
        <span class="link-title">Hospital Management</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>

    <div id="hospital_management" class="{{
                    request()->routeIs('hospital-profiles.*')  ||
                    request()->routeIs('departmentsPosition')  ||
                    request()->routeIs('departments.*')  ? '' : 'collapse'  }} "  >

        <ul class="nav sub-menu">
            <li class="nav-item">
                <a href="{{route('hospital-profiles.index')}}" class="nav-link {{request()->routeIs('hospital-profiles.*') ? 'active' : ''}}">Hospital</a>
            </li>

            <li class="nav-item">
                <a href="{{route('departments.index')}}" class="nav-link {{request()->routeIs('departments.*') ? 'active' : ''}}">Department</a>
            </li>
            <li class="nav-item">
                <a href="{{route('departmentsPosition')}}" class="nav-link {{request()->routeIs('departmentsPosition') ? 'active' : ''}}">Department Position</a>
            </li>

        </ul>
    </div>
</li>

