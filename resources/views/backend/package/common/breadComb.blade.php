<nav class="page-breadcrumb d-flex align-items-center justify-content-between">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('hospital-packages.index')}}">Package section</a></li>
        <li class="breadcrumb-item active" aria-current="page">@yield('action')</li>
    </ol>

    @yield('button')

</nav>
