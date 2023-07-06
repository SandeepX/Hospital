@extends('backend.layouts.master')

@section('title','Download')

@section('action','Add Downloadable Files')

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/backend/css/imageuploadify.min.css')}}">
@endsection

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.download.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('downloads.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="mb-3 col-8">
                                <label for="title" class="form-label">Title </label>
                                <input type="text" class="form-control" id="title" name="title"  value="{{old('title') ?? ''}}" autocomplete="off"  placeholder="Enter Files title">
                            </div>

                            <div class="mb-3 col-8">
                                <h6 class="card-title">File</h6>

                                <div>
                                    <input id="image-uploadify" type="file" name="images[]"
                                           accept=".pdf"  multiple />
                                </div>
                                <small>File Type must be: pdf*</small>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('assets/backend/js/imageuploadify.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#image-uploadify").imageuploadify();
        });
    </script>
@endsection
