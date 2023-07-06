
@extends('frontend.layouts.master')

@section('title',ucfirst($patientDetails->name). ' Detail Page')

@section('main-content')

    <!-- Breadcrumb Starts -->
    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('front.internationalPatients')}}">Our International Patient</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ucfirst($patientDetails->name)}}</li>
                    </ul>
                </nav>
                <h2>{{($patientDetails->name)}}</h2>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Ends -->

    <!-- Service Detail Starts -->
    <section class="service-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="detail-content">
                        <div class="detail-desc">
                            <p>{!! $patientDetails->description !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="detail-sidebar">
                        <div class="sidebar-box">
                            <div class="sidebar-title">
                                <h3>More International Patients</h3>
                            </div>
                            <div class="sidebar-content">
                                <ul>
                                    @forelse($patients as $key =>$value)
                                        <li class="{{ $value->id == $patientDetails->id ? 'active':''}}"><a href="{{route('front.patients-detail',$value->id)}}">{{ucwords($value->name)}}</a></li>
                                    @empty

                                    @endforelse
                                </ul>
                            </div>
                        </div>

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
    </section>
    <!-- Service Detail Ends -->

@endsection
