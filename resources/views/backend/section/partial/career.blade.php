<li class="nav-item  {{
                       request()->routeIs('career-designations.*') ||
                       request()->routeIs('career-applicants.*') ||
                       request()->routeIs('career-opportunities.*')
                          ? 'active' : ''  }} ">

    <a class="nav-link" data-bs-toggle="collapse" href="#career_management" role="button" aria-expanded="false" aria-controls="company">
        <i class="link-icon" data-feather="alert-circle"></i>
        <span class="link-title">Career Section</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>

    <div id="career_management" class="{{
                    request()->routeIs('career-designations.*') ||
                    request()->routeIs('career-applicants.*') ||
                    request()->routeIs('career-opportunities.*')
                   ? '' : 'collapse'  }}"  >
        <ul class="nav sub-menu">

            <li class="nav-item">
                <a href="{{route('career-designations.index')}}" class="nav-link {{request()->routeIs('career-designations.*') ? 'active' : ''}}">Designation</a>
            </li>

            <li class="nav-item">
                <a href="{{route('career-opportunities.index')}}" class="nav-link {{request()->routeIs('career-opportunities.*') ? 'active' : ''}}">Career Lists</a>
            </li>

            <li class="nav-item">
                <a href="{{route('career-applicants.index')}}" class="nav-link {{request()->routeIs('career-applicants.*') ? 'active' : ''}}">Career Applicants</a>
            </li>

        </ul>
    </div>
</li>

