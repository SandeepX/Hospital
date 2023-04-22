<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="FoneUI">
    <meta name="keywords" content="web, hospital, chiryau,best hospital, kathmandu, cyclone nepal, nepal">

    <title>404</title>

    @include('backend.section.head_links')
</head>
<body>

<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">
            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
                    <img src="{{asset('assets/404.svg')}}" class="img-fluid mb-2" alt="404">
                    <h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">404</h1>
                    <h4 class="mb-2">Page Not Found</h4>
                    <h6 class="text-muted mb-3 text-center">Oopps!! The page you were looking for doesn't exist.</h6>
{{--                    <a href="{{route('admin')}}">Back to home</a>--}}
                </div>
            </div>

        </div>
    </div>
</div>

@include('backend.section.body_links')

</body>
</html>


