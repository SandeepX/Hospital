@extends('backend.layouts.master')

@section('title','Create International Patient')

@section('action','Create International Patient')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.internationalPatient.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('international-patients.store')}}" enctype="multipart/form-data" method="POST">
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
