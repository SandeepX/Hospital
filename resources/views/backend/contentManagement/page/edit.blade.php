
@extends('backend.layouts.master')

@section('title','Edit Page Detail')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        <nav class="page-breadcrumb d-flex align-items-center justify-content-between">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Page Edit</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Page</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('pages.update',$pageDetail->id)}}" enctype="multipart/form-data" method="post">
                            @method('PUT')
                            @csrf

                            <div class="col-lg-12 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <textarea class="form-control" name="title"  rows="4">{{ ( isset($pageDetail) ? $pageDetail->title: old('title') )}}</textarea>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label for="marquee_content" class="form-label">Sub Title</label>
                                <textarea class="form-control" name="sub_title"   rows="4">{{ ( isset($pageDetail) ? $pageDetail->sub_title: old('sub_title') )}}</textarea>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label for="description_one" class="form-label">Page Description One</label>
                                <textarea class="form-control" name="description_one" id="tinymceExample"   rows="4">{{ ( isset($pageDetail) ? $pageDetail->description_one: old('description_one') )}}</textarea>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label for="description_two" class="form-label">Page Description Two</label>
                                <textarea class="form-control" name="description_two" id="tinymceExample_2"   rows="4">{{ ( isset($pageDetail) ? $pageDetail->description_two: old('description_two') )}}</textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> Update </button>
                            </div>

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

