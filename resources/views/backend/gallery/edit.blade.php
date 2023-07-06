@extends('backend.layouts.master')

@section('title','Gallery')

@section('action','Add Images')

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/backend/css/imageuploadify.min.css')}}">
@endsection

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.gallery.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('galleries.update',$galleryDetail->id)}}" enctype="multipart/form-data" method="post">
                            @method('PUT')
                            @csrf
                            <div class="mb-3 col-8">
                                <label for="title" class="form-label">Title </label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$galleryDetail->title}}"
                                       autocomplete="off" placeholder="Enter gallery title">
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="upload" class="form-label">Upload Image</label>
                                    <input class="form-control" type="file" id="image" name="image">
                                    @if(isset($galleryDetail) && $galleryDetail->image)
                                        <img  src="{{asset(\App\Models\Gallery::UPLOAD_PATH.'Thumb-'.$galleryDetail->image)}}"
                                              alt="alt" width="150" height="150" >
                                    @endif
                                </div>
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

