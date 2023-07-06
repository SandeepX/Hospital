
@extends('frontend.layouts.master')

@section('title','Our Mission & Vision')

@section('main-content')

    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Our Mission & Vision</li>
                    </ul>
                </nav>
                <h2>Our Mission & Vision</h2>
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
                                    <p>{!!  ucfirst($value->description)  !!}</p>
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


    <!-- About Us Starts -->
    <section class="about-us pb-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="about-content">
                        <div class="section-title">
                            <h3>{{ucfirst($aboutUsDetail->page->sub_title) ?? 'What we Are'}}</h3>
                            <h2>{{ucwords($aboutUsDetail->page->title) ?? 'FIND BEST MEDICAL SOLUTIONS QUICK AND EASY AT CHIRAYU NATIONAL HOSPITAL'}}  <span>Chirayu National Hospital</span></h2>
                        </div>
                        <p>
                            {!!  ucfirst(\Illuminate\Support\Str::limit($aboutUsDetail->description, 500, $end='...')) !!}

                        </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="about-us-image">
                        <img src="{{asset(\App\Models\StaticPageDetail::UPLOAD_PATH.'/Thumb-'.$aboutUsDetail->image)}}" alt="image">
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
                                <div class="service-item1 {{$color_value}}  rounded-0">
                                    <div class="service-icon1 mb-2">
                                        <img src="{{asset(\App\Models\hospitalService::UPLOAD_PATH.$value->png_class)}}">
                                    </div>
                                    <div class="service-content1">
                                        <h3><a href="{{route('front.service-detail',$value->id)}}">{{$value->name}} </a></h3>
                                        <p>{!! ucfirst(\Illuminate\Support\Str::limit($value->short_description, 130, $end='...'))  !!}  </p>
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

@endsection
