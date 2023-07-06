@extends('frontend.layouts.master')

@section('title',ucfirst($departmentDetail->dept_name). ' Detail Page')

@section('main-content')

    <!-- Breadcrumb Starts -->
    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('front.department')}}">Department</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page">{{ucwords($departmentDetail->dept_name)}}</li>
                    </ul>
                </nav>
                <h2>{{ucwords($departmentDetail->dept_name)}}</h2>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Ends -->

    <!-- Service Detail Starts -->
    <section class="service-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="detail-content mb-4">
                        <div class="section-title mar-bottom-30">
                            <h3>{{$departmentDetail->dept_name}}</h3>
                            <h2>We are here to <span>help when you need.</span></h2>
                        </div>
                        <div class="detail-image mar-bottom-15">
                            <img src="{{asset(App\Models\Department::UPLOAD_PATH.$departmentDetail->image)}}"
                                 alt="Image">
                        </div>
                        <div class="detail-desc">
                            <p>
                                {!! $departmentDetail->description !!}
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title">
                                <h3>MEET OUR EXPERIENCED TEAM</h3>
                                <h2>Our Dedicated <span>Doctors</span> Team</h2>
                            </div>
                        </div>
                    </div>
                    @if(count($departmentDetail->doctors) > 0)
                        <div class="doctor-item">
                            <div class="row">
                                @forelse($doctors as $key => $doctor)
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="special-main">
                                            <div class="special-item">
                                                <div class="special-image">
                                                    <a href="{{route('front.doctor.show',$doctor->id)}}">
                                                        <img
                                                            src="{{asset(\App\Models\Doctor::UPLOAD_PATH.'Thumb-'.$doctor->avatar)}}"
                                                            alt="image" style="object-fit:cover; max-height:350px; min-height: 350px;" >
                                                    </a>
                                                    <div class="special-links">
                                                        <ul>
                                                            @if($doctor->fb_link)
                                                                <li><a href="{{$doctor->fb_link}}"><i
                                                                            class="fa fa-facebook"
                                                                            aria-hidden="true"></i></a></li>
                                                            @endif
                                                            @if($doctor->insta_link)
                                                                <li><a href="{{$doctor->fb_link}}"><i
                                                                            class="fa fa-instagram"
                                                                            aria-hidden="true"></i></a></li>
                                                            @endif
                                                            @if($doctor->twitter_link)
                                                                <li><a href="{{$doctor->fb_link}}"><i
                                                                            class="fa fa-twitter"
                                                                            aria-hidden="true"></i></a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="color-overlay"></div>
                                                </div>
                                                <div class="special-content">
                                                    <h4>
                                                        <a href="{{route('front.doctor.show',$doctor->id)}}">{{$doctor->full_name}}</a>
                                                    </h4>
                                                    <p>{{$doctor->speciality}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty

                                @endforelse

                            </div>
                        </div>
                    @endif

                </div>
                <div class="col-md-4">
                    <div class="detail-sidebar">
                        <div class="sidebar-box">
                            <div class="sidebar-title">
                                <h3>More Department </h3>
                            </div>
                            <div class="sidebar-content">
                                <ul>
                                    @forelse($departments as $key =>$value)
                                        <li class="{{ $value->id == $departmentDetail->id? 'active':''}}"><a
                                                href="{{route('front.department-detail',$value->id)}}">{{ucwords($value->dept_name)}}</a>
                                        </li>
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
