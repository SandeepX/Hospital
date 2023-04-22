<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="FoneUI">
    <meta name="keywords" content="FoneUI, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{asset('assets/backend/vendors/core/core.css')}}">
    <!-- endinject -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/backend/fonts/feather-font/css/iconfont.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('assets/backend/css/style.css')}}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{asset('assets/backend/images/favicon.png')}}" />

    @yield('auth-styles')
</head>
<body>
@yield('auth-content')

<!-- core:js -->
<script src="{{asset('assets/backend/vendors/core/core.js')}}"></script>
<!-- endinject -->

<!-- inject:js -->
<script src="{{asset('assets/backend/vendors/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/backend/js/template.js')}}"></script>
<!-- endinject -->

<script>
    $('div.alert.alert-success').not('.alert-important').delay(5000).slideUp(900);
    $('div.alert.alert-danger').not('.alert-important').delay(9000).slideUp(900);
</script>

@yield('auth-scripts')

</body>
</html>
