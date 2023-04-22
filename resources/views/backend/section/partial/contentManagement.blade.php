<li class="nav-item  {{
                       request()->routeIs('pages.*') ||
                       request()->routeIs('staticPageDetails.*') ||
                       request()->routeIs('media-links.*') ||
                       request()->routeIs('downloads.*') ||
                       request()->routeIs('banners.*')
                          ? 'active' : ''  }} ">

    <a class="nav-link" data-bs-toggle="collapse" href="#content_management" role="button" aria-expanded="false" aria-controls="company">
        <i class="link-icon" data-feather="align-right"></i>
        <span class="link-title">Content Management</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
    </a>

    <div id="content_management" class="{{
                    request()->routeIs('pages.*') ||
                    request()->routeIs('staticPageDetails.*') ||
                    request()->routeIs('media-links.*') ||
                    request()->routeIs('downloads.*') ||
                    request()->routeIs('banners.*')
                   ? '' : 'collapse'  }}"  >
        <ul class="nav sub-menu">
            <li class="nav-item">
                <a href="{{route('banners.index')}}" class="nav-link {{request()->routeIs('banners.*') ? 'active' : ''}}">Banner</a>
            </li>

            <li class="nav-item">
                <a href="{{route('pages.index')}}" class="nav-link {{request()->routeIs('pages.*') ? 'active' : ''}}">Page</a>
            </li>
            <li class="nav-item">
                <a href="{{route('staticPageDetails.index')}}" class="nav-link {{request()->routeIs('staticPageDetails.*') ? 'active' : ''}}">Static Page Detail</a>
            </li>
            <li class="nav-item">
                <a href="{{route('media-links.index')}}" class="nav-link {{request()->routeIs('media-links.*') ? 'active' : ''}}">Media Link</a>
            </li>
            <li class="nav-item">
                <a href="{{route('downloads.index')}}" class="nav-link {{request()->routeIs('downloads.*') ? 'active' : ''}}">Download File</a>
            </li>

        </ul>
    </div>
</li>

