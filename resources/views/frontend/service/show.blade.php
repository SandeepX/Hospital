
@extends('frontend.layouts.master')

@section('title',ucfirst($serviceDetail->name). ' Detail Page')

@section('main-content')

<!-- Breadcrumb Starts -->
<section class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-outer text-center">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('front.service')}}">Services</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ucfirst($serviceDetail->name)}}</li>
                </ul>
            </nav>
            <h2>{{($serviceDetail->name)}}</h2>
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
                    <div class="section-title mb-4">
                        <h3>{{($serviceDetail->name)}}</h3>
                        <h2>We are here to <span>help when you need us.</span></h2>
                    </div>
                    <div class="detail-image mb-2">
                        <img src="{{asset(\App\Models\HospitalService::UPLOAD_PATH.'/'.$serviceDetail->image)}}" alt="Image">
                    </div>
                    <div class="detail-desc">
                        <p>{!! $serviceDetail->description !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="detail-sidebar">
                    <div class="sidebar-box">
                        <div class="sidebar-title">
                            <h3>More Services</h3>
                        </div>
                        <div class="sidebar-content">
                            <ul>
                                @forelse($services as $key =>$value)
                                    <li class="{{ $value->id == $serviceDetail->id ? 'active':''}}"><a href="{{route('front.service-detail',$value->id)}}">{{ucwords($value->name)}}</a></li>
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
