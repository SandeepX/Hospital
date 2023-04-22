
@extends('backend.layouts.master')

@section('title','Edit International Patient')

@section('action','Edit International Patient')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.internationalPatient.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('international-patients.update',$internationalPatientDetail->id)}}" enctype="multipart/form-data" method="post">
                            @method('PUT')
                            @csrf
                            @include('backend.internationalPatient.common.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')

    @include('backend.internationalPatient.common.scripts')

@endsection

