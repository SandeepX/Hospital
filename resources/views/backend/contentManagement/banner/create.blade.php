@extends('backend.layouts.master')

@section('title','Create Banner')

@section('action','Create Banner')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.contentManagement.banner.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('banners.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @include('backend.contentManagement.banner.common.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
    @include('backend.contentManagement.banner.common.scripts')
@endsection
