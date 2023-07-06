<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="Chirayu">
    <meta name="keywords" content="Chirayu, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>@yield('title')</title>

    @include('backend.section.head_links')

    @yield('styles')
</head>
<body>
<div class="main-wrapper">


    @include('backend.section.sidebar')

    <div class="page-wrapper">
        @include('backend.section.nav')

        <div class="page-content">
            @include('backend.section.page_header')
            @yield('main-content')
        </div>


        <!-- partial -->
        @include('backend.section.footer')
    </div>
</div>



@include('backend.section.body_links')

@yield('scripts')

</body>

</html>
