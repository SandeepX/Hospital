
    <li class="nav-item {{ request()->routeIs('contact-us.*') ? 'active' : ''  }} ">
          <a href="{{route('contact-us.index')}}" class="nav-link {{request()->routeIs('contact-us.*') ? 'active' : ''}} ">
            <i class="link-icon" data-feather="twitter"></i>
            <span class="link-title">Contact Us</span>
          </a>
    </li>
