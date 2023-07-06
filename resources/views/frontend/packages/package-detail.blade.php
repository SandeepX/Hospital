@extends('frontend.layouts.master')

@section('title',ucfirst($packagesDetail->package_name). ' Detail Page')

@section('main-content')

    <!-- Breadcrumb Starts -->
    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('front.package')}}">Package</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ucwords($packagesDetail->package_name)}}</li>
                    </ul>
                </nav>
                <h2>{{ucwords($packagesDetail->package_name)}}</h2>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Ends -->

    <!-- Service Detail Starts -->
    <section class="service-detail">
        <div class="container">
            <div class="package-title col-md-12 d-flex">
                <div class="package-image col-md-6">
                    <img  src="{{asset(\App\Models\Package::UPLOAD_PATH.'/Thumb-'.$packagesDetail->image)}}" class="w-100" alt="Image">
                </div>

                <div class="package-title-content col-md-6">
                    <div class="package content-item">
                        <ul>
                            <li><strong>Package Name:</strong> {{ucfirst($packagesDetail->package_name)}}</li>
                            <li><strong>Package Price:</strong> {{($packagesDetail->package_price)}}</li>
                            <li><strong>Package Title:</strong> {{($packagesDetail->title??'N/A')}}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="doctor-content package-main">
                <div class="row">
                    <div class="col-md-8">
                        <div class="detail-content">
                            <div class="detail-desc">
                                    {!! ucfirst($packagesDetail->description)!!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="sidebar-ad">
                            <div class="ad-content">
                                <p>We are available 24/7</p>
                                <h3>Medical and Health consultant at your service</h3>
                                <a href="{{route('front.contact-us')}}" class="btn"> Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Service Detail Ends -->

@endsection
