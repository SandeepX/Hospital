@extends('frontend.layouts.master')

@section('title','Package Lists')

@section('main-content')

    <!-- Breadcrumb Starts -->
    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Package</li>
                    </ul>
                </nav>
                <h2>Package</h2>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Ends -->


    <!-- package Starts -->
    <section class="department-services icon-left">
        <div class="container">
            <div class="row">
                @forelse($packages as $key => $value)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-icon mb-2">
                                <img src="{{asset(\App\Models\Package::UPLOAD_PATH.'/Thumb-'.$value->package_icon)}}" alt="Image">
                            </div>
                            <div class="service-content">
                                <h3>{{ucfirst($value->package_name)}}</h3>

                                <span class="package-price mb-2">Rs. {{$value->package_price}}</span>

                                <a href="{{route('front.package-detail',$value->id)}}" class="btn">View More</a>

                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        </div>
    </section>
    <!-- package Ends -->

@endsection
