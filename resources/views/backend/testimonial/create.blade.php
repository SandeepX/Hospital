@extends('backend.layouts.master')

@section('title','Create Testimonial')

@section('action','Create Testimonial')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.testimonial.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('testimonials.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @include('backend.testimonial.common.form')

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>



@endsection

@section('scripts')

    @include('backend.testimonial.common.scripts')

@endsection
