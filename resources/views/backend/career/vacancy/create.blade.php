@extends('backend.layouts.master')

@section('title','Create Vacancy')

@section('action','Create Vacancy')

@section('main-content')

<section class="content">

        @include('backend.section.flash_message')

        @include('backend.career.vacancy.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('career-opportunities.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @include('backend.career.vacancy.common.form')

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>



@endsection

@section('scripts')

    @include('backend.career.vacancy.common.scripts')

@endsection
