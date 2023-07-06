
<!-- partial:partials/_navbar.html -->
<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <form class="search-form">
            <div class="input-group">
                <div class="input-group-text">
                    <i data-feather="activity"></i>
                </div>
                <h3 class="form-control me-3" id="navbarForm"> CHIRAYU NATIONAL HOSPITAL</h3>
            </div>
        </form>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="wd-30 ht-30 rounded-circle" style="object-fit: cover" src="{{asset(\App\Models\User::AVATAR_UPLOAD_PATH.\Illuminate\Support\Facades\Auth::user()->avatar)}}" alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle"  style="object-fit: cover" src="{{asset(\App\Models\User::AVATAR_UPLOAD_PATH.\Illuminate\Support\Facades\Auth::user()->avatar)}}" alt="">
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ucfirst(auth()->user()->name)}}</p>
                            <p class="tx-12 text-muted">{{(auth()->user()->email)}}</p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        @if(auth()->user()->role == 'admin')
                            <li class="dropdown-item py-2">
                                <a href="{{route('users.show',auth()->user()->id)}}" class="text-body ms-0">
                                    <i class="me-2 icon-md" data-feather="user"></i>
                                    <span>Profile</span>
                                </a>
                            </li>
                            <li class="dropdown-item py-2">
                                <a href="{{route('users.edit',auth()->user()->id)}}" class="text-body ms-0">
                                    <i class="me-2 icon-md" data-feather="edit"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </li>
                        @endif

                        <li class="dropdown-item py-2">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();" class="text-body ms-0">

                                <i class="me-2 icon-md" data-feather="log-out"> </i>log out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- partial -->
