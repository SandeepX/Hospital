
@extends('backend.layouts.master')

@section('title','Edit Department Detail')

@section('action','Edit Department')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.department.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('departments.update',$departmentDetails->id)}}" enctype="multipart/form-data" method="post">
                            @method('PUT')
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

