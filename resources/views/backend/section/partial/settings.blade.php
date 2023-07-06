<li class="nav-item  {{
                       request()->routeIs('doctor-page-settings.*') ? 'active' : ''  }} ">

    <a class="nav-link" data-bs-toggle="collapse" href="#hospital_management" role="button" aria-expanded="false" aria-controls="company">
        <i class="link-icon" data-feather="settings"></i>
        <span class="link-title">Setting</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>

    <div id="hospital_management" class="{{
                    request()->routeIs('doctor-page-settings.*')  ? '' : 'collapse'  }} "  >

        <ul class="nav sub-menu">
            <li class="nav-item">
                <a href="{{route('doctor-page-settings.index')}}" class="nav-link {{request()->routeIs('doctor-page-settings.*') ? 'active' : ''}}">Doctor Page Title</a>
            </li>

        </ul>
    </div>
</li>



