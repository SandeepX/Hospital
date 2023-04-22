
@extends('backend.layouts.master')

@section('title','Edit User Detail')

@section('action','Edit User')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.users.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('users.update',$userDetail->id)}}" enctype="multipart/form-data" method="post">
                            @method('PUT')
                            @csrf
                            @include('backend.users.common.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')

    @include('backend.users.common.scripts')

@endsection

