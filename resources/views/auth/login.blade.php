@extends('auth.main')

@section('title','login')

@section('auth-content')

    <section class="content">
            <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">
                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        @include('backend.section.flash_message')
                        <div class="card">
                            <div class="row">
                                <div class="col-md-4 pe-md-0">
                                    <div class="auth-side-wrapper">
                                        <img src="{{asset('assets/backend/images/chirayu_logo.jpg')}}" width="219" height="452"  alt="alt">
                                    </div>
                                </div>
                                <div class="col-md-8 ps-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#" class="noble-ui-logo d-block mb-2">Chirayau Hospital</a>
                                        <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>

                                        <form class="forms-sample" method="post" action="{{route('login')}}">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="userEmail" class="form-label">Email address</label>
                                                <input
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}"
                                                    required
                                                    autocomplete="email"
                                                    autofocus
                                                >
                                                @if ($errors->has('email'))
                                                    <span class="text-danger">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label for="userPassword" class="form-label">Password</label>
                                                <input id="password"
                                                       type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password"
                                                       required
                                                       autocomplete="current-password"
                                                >
                                                @if ($errors->has('password'))
                                                    <span class="text-danger">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>

                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    Remember me
                                                </label>
                                            </div>

                                            <div>
                                                <button type="submit" class=" btn btn-primary me-2 mb-2 mb-md-0 text-white">
                                                    Login
                                                </button>

                                                @if (Route::has('password.request'))
                                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                                        {{ __('Forgot Your Password?') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </section>

@endsection
