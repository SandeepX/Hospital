
@extends('backend.layouts.master')

@section('title','Edit Static Page Detail')

@section('action','Edit Static Page Detail')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.contentManagement.staticPageDetail.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('staticPageDetails.update',$staticPageDetail->id)}}" enctype="multipart/form-data" method="post">
                            @method('PUT')
                            @csrf
                            @include('backend.contentManagement.staticPageDetail.common.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')

    @include('backend.contentManagement.staticPageDetail.common.scripts')

@endsection

