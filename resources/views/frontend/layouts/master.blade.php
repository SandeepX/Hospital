<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @include('frontend.section.head_links')
    @yield('front-styles')
</head>
<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status"></div>
    </div>

    @include('frontend.section.header')

    @yield('main-content')

    @include('frontend.section.footer')

    <!-- Back to top start -->
    <div id="back-to-top">
        <a href="#"></a>
    </div>
    <!-- Back to top ends -->

    @include('frontend.layouts.sidebar-mobile')

    <!-- search popup -->
    <div id="search1">
        <button type="button" class="close">×</button>
        <form action="{{route('front.doctors')}}" method="get">
            <input type="search" name="name" value="{{$filterParameter['name'] ?? ''}}" placeholder="search department here" />
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    @include('frontend.section.body-links')

    @yield('front-scripts')

</body>
</html>


