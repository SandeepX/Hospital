
@extends('backend.layouts.master')

@section('title','Additional Hospital Service')

@section('action','Edit Additional Service')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.hospitalService.extraService.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('hospital-extra-services.update',$extraServiceDetail->id)}}"  method="post">
                            @method('PUT')
                            @csrf
                            @include('backend.hospitalService.extraService.common.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')

    @include('backend.hospitalService.extraService.common.scripts')

@endsection

