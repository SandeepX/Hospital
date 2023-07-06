@extends('frontend.layouts.master')

@section('title','Our International Patients')

@section('main-content')

    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Our International Patients</li>
                    </ul>
                </nav>
                <h2>Our International Patients</h2>
            </div>
        </div>
    </section>


    <section class="patients mt-5 icon-left patients-1">
        <div class="container">
            <div class="row">
                @forelse($internationalPatient as $key => $datum)
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-8">
                        <div class="patient-item patient-item-1">
                            <div class="patient-icon-1 mar-bottom-20">
                                <img src="{{asset(\App\Models\OurInternationalPatient::UPLOAD_PATH.'Thumb-'.$datum->image)}}">
                            </div>
                            <div class="patient-content">
                                <h3><a href="{{route('front.patients-detail',$datum->id)}}">{{ucfirst($datum->name)}} </a></h3>
                                <p>{!! ucfirst($datum->short_intro)  !!}</p>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        </div>
    </section>

@endsection
