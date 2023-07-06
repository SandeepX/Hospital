
@extends('backend.layouts.master')

@section('title','Edit Hospital Service')

@section('action','Edit Top Service')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.hospitalService.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('hospital-services.update',$hospitalServiceDetail->id)}}" enctype="multipart/form-data" method="post">
                            @method('PUT')
                            @csrf
                            @include('backend.hospitalService.common.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')

    @include('backend.hospitalService.common.scripts')

@endsection

