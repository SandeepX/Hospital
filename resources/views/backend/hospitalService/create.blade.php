@extends('backend.layouts.master')

@section('title','Create Hospital Service')

@section('action','Create Top Service')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.hospitalService.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('hospital-services.store')}}" enctype="multipart/form-data" method="POST">
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
