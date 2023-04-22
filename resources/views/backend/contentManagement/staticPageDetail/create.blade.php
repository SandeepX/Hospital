@extends('backend.layouts.master')

@section('title','Create Static Page Detail')

@section('action','Create Static Page Detail')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.contentManagement.staticPageDetail.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('staticPageDetails.store')}}" enctype="multipart/form-data" method="POST">
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
