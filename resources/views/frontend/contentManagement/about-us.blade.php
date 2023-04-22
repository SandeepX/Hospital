
@extends('frontend.layouts.master')

@section('title','About Us')

@section('main-content')

<section class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-outer text-center">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ul>
            </nav>
            <h2>About Us</h2>
        </div>
    </div>
</section>

<!-- About Us Starts -->
<section class="about-us pb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="about-content">
                    <div class="section-title">
                        <h3>{{ucfirst($aboutUsDetail?->page?->sub_title) ?? 'What we Are'}}</h3>
                        <h2>{{ucwords($aboutUsDetail?->page?->title) ?? 'FIND BEST MEDICAL SOLUTIONS QUICK AND EASY AT CHIRAYU NATIONAL HOSPITAL'}}  <span>Chirayu National Hospital</span></h2>
                    </div>
                    <p>
                        {!! $aboutUsDetail?->description !!}
                    </p>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="about-us-image">
                    <img src="{{asset(\App\Models\StaticPageDetail::UPLOAD_PATH.'/Thumb-'.$aboutUsDetail?->image)}}" alt="image">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us Ends -->

<section class="services-list pt-0">
    <div class="container">
        <div class="service-outer1">
            <div class="service-box1 mt-0 position-relative top-0">
                <div class="row">
                    @foreach($quickServices as $key => $value)
                        @php
                            $color_value = ($loop->iteration % 2 == 0)? "child-3" : "child-2";
                        @endphp
                        <div class="col-lg-3 col-md-6">
                            <div class="service-item1 rounded-bottom {{$color_value}}  rounded-0">
                                <div class="service-icon1 mb-2">
                                    <img src="{{asset(\App\Models\hospitalService::UPLOAD_PATH.$value->png_class)}}">
                                </div>
                                <div class="service-content1">
                                    <h3><a href="{{route('front.service-detail',$value->id)}}">{{$value->name}} </a></h3>
                                    <p>{!!  ucfirst(\Illuminate\Support\Str::limit($value->short_description, 130, $end='...'))  !!}</p>
                                </div>
                            </div>
                        </div>
                        @php
                            if($loop->iteration === 4){
                                break;
                            }
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Starts -->
<section class="call-to-action pt-10 pb-6">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-6 mb-4">
                <div class="section-title">
                    <h3>OUR MEDICAL</h3>
                    <h2>Setting the Standards in <span>Research & Clinical Care</span></h2>
                </div>
                <div class="action-content">
                    @forelse($missionAndVision as $key => $value)
                        <div class="statement-item {{$loop->first ? 'mb-4':''}}">
                            <div class="statement-icon mb-2">
                                <i class="{{\App\Helpers\AppHelper::PNG_CLASS[$key] ?? 'flaticon-018-vaccine'}}"></i>
                            </div>
                            <div class="statement-content">
                                <h3 class="mb-0">{{$value->title}}</h3>
                                <p>{!! ucfirst(\Illuminate\Support\Str::limit($value->description, 80, $end='...'))  !!}  </p>
                            </div>
                        </div>
                    @empty

                    @endforelse
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="video-outer">
                    <div class="video-content">
                        <iframe width="590" height="350" src="https://www.youtube.com/embed/{{$video ?? ""}}"
                                title="YouTube video player"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Call to Action Ends -->

<!-- Director Message Starts -->
<section class="maindoctor mt-3">
    <div class="container">
        <div class="maindoctor-main">
            <div class="maindoctor-list">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="maindoctor-image">
                            <img src="{{asset(\App\Models\StaticPageDetail::UPLOAD_PATH.'Thumb-'.($directorMessage->image ?? "" ) )}}" alt="image">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6">
                        <div class="maindoctor-content">
                            <h4>{{$directorMessage->page?->title ?? 'N/A'}}</h4>
                            <h2 class="mb-1">{{$directorMessage->sub_title ?? 'N/A'}}</h2>
                            <p>
                                {!! ucfirst($directorMessage->description ?? 'N/A') !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Director Message Ends -->

<!-- Specialist Starts -->
<section class="specialist  mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h3>MEET OUR EXPERIENCED TEAM</h3>
                    <h2>Our Dedicated <span>Doctors</span> Team</h2>
                </div>
            </div>
        </div>
        <div class="specialist-slider row">
            @forelse($doctors as $key =>$value)
                <div class="col-lg-3">
                    <div class="special-main">
                        <div class="special-item">
                            <div class="special-image">
                                <a href="{{route('front.doctor.show',$value->id)}}">
                                    <img src="{{asset(\App\Models\Doctor::UPLOAD_PATH.'/Thumb-'.$value->avatar)}}" alt="image"
                                         style="object-fit:cover; max-height:350px; min-height: 350px;">
                                </a>
                                <div class="special-links">
                                    <ul>
                                        <li><a href="{{$value->fb_link}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="{{$value->insta_link}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="{{$value->twitter_link}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <div class="color-overlay"></div>
                            </div>
                            <div class="special-content">
                                <h4><a href="{{route('front.doctor.show',$value->id)}}">{{$value->full_name}}</a></h4>
                                <p>{{$value->speciality}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty

            @endforelse
        </div>
    </div>
</section>
<!-- Specialist Ends -->

<!-- Testimonial Starts -->
<section class="testimonial">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 col-sm-12">
                <div class="section-title title-white m-2">
                    <h3>CLIENTS</h3>
                    <h2>Happy <span>Patients & Clients</span></h2>
                    <p>If you need any medical help we are available for you. </p>
                    <a href="#" class="btn mt-4">View more Details <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row testimonial-slider">

                    @forelse($testimonial as $key => $testimonialDetail)

                        <div class="col-lg-12">
                            <div class="slider-item">
                                <div class="slider-content">
                                    <div class="quote-icon">
                                        <img src="{{asset('assets/frontend/images/quote-icon-1.png')}}" alt="Image">
                                    </div>
                                    <div class="slider-author clearfix">
                                        <div class="testimonial-image mb-2">
                                            <img src="{{asset(\App\Models\Testimonial::UPLOAD_PATH.'/Thumb-'.$testimonialDetail->image)}}" alt="Image">
                                        </div>
                                        <div class="author-content pad-top-10">
                                            <h3 class="mar-bottom-0">{{$testimonialDetail->name}}</h3>
                                            <p>{{ucfirst($testimonialDetail->post)}}</p>
                                        </div>
                                    </div>
                                    <div class="rating">
                                        @for($i=0;$i<$testimonialDetail->rating;$i++)
                                            <span class="fa fa-star checked"></span>
                                        @endfor
                                    </div>
                                    <p>{!! ucfirst(substr($testimonialDetail->description, 0, 300)).'...' !!}</p>
                                </div>
                            </div>
                        </div>
                    @empty

                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
</section>
<!-- Testimonial Ends -->

@endsection


