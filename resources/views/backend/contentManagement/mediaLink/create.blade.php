@extends('backend.layouts.master')

@section('title','Add Media Link')

@section('action','Add Media Link')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.contentManagement.mediaLink.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form id="mediaLinks" class="forms-sample" action="{{route('media-links.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row" id="links">
                                <div class="row" id="mediaLink0">
                                    <div class="col-lg-3 mb-3">
                                        <label for="link_type" class="form-label">Media Link Type 1</label>
                                        <select class="form-select" id="link_type" name="media[0][link_type]"  required>
                                            <option value="" selected  disabled>Select </option>
                                            @foreach(\App\Models\MediaLink::LINK_TYPE as $value)
                                                <option value="{{$value}}">{{ucfirst($value)}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="url" class="form-label"> Media link 1</label>
                                        <input type="url" class="form-control" id="url" name="media[0][url]" value="" autocomplete="off" required placeholder="">
                                    </div>

                                    <div class="col-lg-3 mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Status</label>
                                        <select class="form-select" id="is_active" name="media[0][is_active]">
                                            <option value="" selected disabled>Select status</option>
                                            <option value="1" >Active</option>
                                            <option value="0" >Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-2 d-flex">
                                        <div class="mt-4" >
                                            <button type="button" class="form-control btn-secondary btn-xs" id="addMore" >Add More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary m-2"><i class="link-icon" data-feather="plus"></i> Save </button>
                            </div>
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
