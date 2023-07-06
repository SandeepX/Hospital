
@extends('backend.layouts.master')

@section('title','Hospital Profile')

{{--@section('nav-head','Company')--}}

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        <nav class="page-breadcrumb d-flex align-items-center justify-content-between">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Hospital Profile</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">Hospital Profile</h4>
                        @if(!$hospitalProfileDetail)
                            <form class="forms-sample" action="{{route('hospital-profiles.store')}}" enctype="multipart/form-data" method="POST">
                                @else
                            <form class="forms-sample" action="{{route('hospital-profiles.update',$hospitalProfileDetail->id)}}" enctype="multipart/form-data" method="post">
                                @method('PUT')
                                @endif
                                @csrf
                                @include('backend.hospital.form')
                            </form>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection


@section('scripts')
    <script src="{{asset('assets/backend/vendors/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/tinymce.js')}}"></script>
@endsection


