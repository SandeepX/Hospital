
@extends('backend.layouts.master')

@section('title','Edit Team Detail')

@section('action','Edit Team')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.team.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('team.update',$teamDetails->id)}}" enctype="multipart/form-data" method="post">
                            @method('PUT')
                            @csrf
                            @include('backend.team.common.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')

    @include('backend.team.common.scripts')

@endsection

