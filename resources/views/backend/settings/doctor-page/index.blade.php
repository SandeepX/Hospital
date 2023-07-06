
@extends('backend.layouts.master')

@section('title','Doctor Page Setting')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        <nav class="page-breadcrumb d-flex align-items-center justify-content-between">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Doctor Page Setting</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">Doctor Page Titles Setting</h4>
                        @if(!$doctorPageSettingDetail)
                            <form class="forms-sample" action="{{route('doctor-page-settings.store')}}" method="POST">
                                @else
                                    <form class="forms-sample" action="{{route('doctor-page-settings.update',$doctorPageSettingDetail->id)}}"  method="post">
                                        @method('PUT')
                                        @endif
                                        @csrf
                                        @include('backend.settings.doctor-page.form')
                                    </form>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection





