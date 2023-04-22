
@extends('backend.layouts.master')

@section('title','Edit Package Detail')

@section('action','Edit Package')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.package.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('hospital-packages.update',$packageDetail->id)}}" enctype="multipart/form-data" method="post">
                            @method('PUT')
                            @csrf
                            @include('backend.package.common.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')

    @include('backend.package.common.scripts')

@endsection

