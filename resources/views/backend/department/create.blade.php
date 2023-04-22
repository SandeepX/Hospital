@extends('backend.layouts.master')

@section('title','Create Department')

@section('action','Create Department')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.department.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('departments.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @include('backend.department.common.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
  @include('backend.department.common.scripts')
@endsection
