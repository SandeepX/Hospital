
<li class="nav-item {{request()->routeIs('hospital-services.*') ||
                        request()->routeIs('hospital-extra-services.*')
  ? 'active' : ''  }} ">
    <a class="nav-link" data-bs-toggle="collapse" href="#service_section" role="button" aria-expanded="false" aria-controls="company">
        <i class="link-icon" data-feather="server"></i>
        <span class="link-title">Service Section</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>

    <div id="service_section" class="{{ request()->routeIs('hospital-services.*') ||
                            request()->routeIs('hospital-extra-services.*')
            ? '' : 'collapse'  }} ">
       <ul class="nav sub-menu">
            <li class="nav-item">
                <a href="{{route('hospital-services.index')}}" class="nav-link {{request()->routeIs('doctors.*') ? 'active' : ''}}">Main Service List</a>
            </li>
            <li class="nav-item">
                <a href="{{route('hospital-extra-services.index')}}" class="nav-link {{request()->routeIs('hospital-extra-services.*') ? 'active' : ''}}">Extra Service List</a>
            </li>
        </ul>
    </div>
</li>




