
@extends('backend.layouts.master')

@section('title','Edit Event Detail')

@section('action','Edit Event')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.event.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('events.update',$eventDetails->id)}}" enctype="multipart/form-data" method="post">
                            @method('PUT')
                            @csrf
                            @include('backend.event.common.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')

    @include('backend.event.common.scripts')

@endsection

