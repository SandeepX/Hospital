@extends('backend.layouts.master')

@section('title','Create Team')

@section('action','Create Team')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.team.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('team.store')}}" enctype="multipart/form-data" method="POST">
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
