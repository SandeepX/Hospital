
@extends('backend.layouts.master')

@section('title','Edit Media Link')

@section('action','Edit Media Link')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.contentManagement.mediaLink.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('media-links.update',$mediaLinkDetail->id)}}" enctype="multipart/form-data" method="post">
                            @method('PUT')
                            @csrf
                            @include('backend.contentManagement.mediaLink.common.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')

    @include('backend.contentManagement.mediaLink.common.scripts')

@endsection

