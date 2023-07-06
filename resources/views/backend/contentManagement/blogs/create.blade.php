@extends('backend.layouts.master')

@section('title','Create Blog')

@section('action','Create Blog')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.contentManagement.blogs.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('blogs.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @include('backend.contentManagement.blogs.common.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
    @include('backend.contentManagement.blogs.common.scripts')
@endsection
