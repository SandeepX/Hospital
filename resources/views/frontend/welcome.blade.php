@extends('frontend.layouts.master')

@section('title','Chirayu National Hospital')

@section('main-content')

    @include('frontend.section.flash_message')

    <!-- Slider Starts -->
    <section class="slider">
        <div id="fw_al_003" class="carousel ps_fade ps_control_bsquare swipe_x ps_easeOutQuint" data-ride="carousel"
             data-pause="hover" data-interval="5000" data-duration="2000">
            <!-- Wrapper For Slides -->
            <div class="carousel-inner" role="listbox">

                @forelse($banner as $key => $value)
                    <div class="item {{($loop->first) ? 'active' :''}} ">
                        <!-- Slide Background -->
                        <img
                            src="{{$value->image ? \App\Models\Banner::UPLOAD_PATH.'/'.$value->image :asset('assets/frontend/images/ophthalmology/slider/slider1.jpg')}}"
                            alt="fw_al_003_01"/>
                        <!-- Slide Text Layer -->
                        <div class="fw_al_003_slide">
                            <h1 data-animation="animated fadeInDown">{{ucfirst($value->title)}}</h1>
                            <p data-animation="animated fadeIn">{{ucfirst($value->sub_title)}}.</p>
                            <a data-animation="animated fadeInRight" href="{{route('front.appointment.appointmentCreate')}}"
                               class="btn"> Book An Appointment</a>
                        </div>
                    </div>
                @empty

                @endforelse

            </div><!-- End of Wrapper For Slides -->
            <!-- Left Control -->
            <a class="left carousel-control" href="#fw_al_003" role="button" data-slide="prev">
                <span class="fa fa-angle-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <!-- Right Control -->
            <a class="right carousel-control" href="#fw_al_003" role="button" data-slide="next">
                <span class="fa fa-angle-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div> <!-- End Paradise Slider -->
    </section>
    <!-- Slider Ends -->

    <section class="services-list">
        <div class="container">
            <div class="service-outer1">
                <div class="service-box1">
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

    <!-- About Us Starts -->
    <section class="about-us pb-0 mt-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="about-content">
                        <div class="section-title">
                            <h3>{{ucfirst($aboutUsDetail?->page?->sub_title)}}</h3>
                            <h2>{{ucwords($aboutUsDetail?->page?->title)}} <span>Chirayu National Hospital</span>
                            </h2>
                        </div>
                        <p>
                            {!! ucfirst($aboutUsDetail?->description) !!}
                        </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="about-us-image">
                        <img src="{{asset(\App\Models\StaticPageDetail::UPLOAD_PATH.'/'.$aboutUsDetail?->image)}}"
                             alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Ends -->

    <!-- Specialist Starts -->
    <section class="specialist pb-0">
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
                                        <img src="{{asset(\App\Models\Doctor::UPLOAD_PATH.'/Thumb-'.$value->avatar)}}"
                                             alt="image" style="object-fit:cover; max-height:350px; min-height: 350px;"></a>
                                    <div class="special-links">
                                        <ul>
                                            @if($value->fb_link)
                                                <li><a href="{{$value->fb_link}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            @endif
                                            @if($value->insta_link)
                                                <li><a href="{{$value->fb_link}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                            @endif
                                            @if($value->twitter_link)
                                                <li><a href="{{$value->fb_link}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="color-overlay"></div>
                                </div>
                                <div class="special-content">
                                    <h4><a href="{{route('front.doctor.show',$value->id)}}">{{$value->full_name}}</a>
                                    </h4>
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

    <!-- service starts -->
    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>WE OFFER SERVICES</h3>
                        <h2>Special <span>High-quality</span> Services</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse($services as $key => $value)
                    @php
                        $color_value = ($loop->iteration % 2 == 0)? "child-3" : "";
                    @endphp
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-icon mb-2 {{$color_value}}">
                                <img src="{{asset(\App\Models\hospitalService::UPLOAD_PATH.$value->png_class)}}">
                            </div>
                            <div class="service-content">
                                <h3><a href="{{route('front.service-detail',$value->id)}}">{{$value->name}} </a></h3>
                                {!!  ucfirst(\Illuminate\Support\Str::limit($value->short_description, 100, $end='...'))  !!}
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse

                <div class="col-lg-12">
                    <div class="text-center">Don’t hesitate, contact us for better help and services. <a href="{{route('front.contact-us')}}"><u>Let’s
                                get started</u></a></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Ends -->

    <!-- Gallery Starts -->
    <section class="gallery">
        <div class="container">
            <div class="row d-lg-flex align-items-center mb-5">
                <div class="col-lg-8">
                    <div class="section-title text-lg-left text-center mb-0">
                        <h3>Our Gallery</h3>
                        <h2>Check Our Beautiful <span>Gallery</span></h2>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-right text-center">
                    <a href="{{route('front.gallery')}}" class="btn btn-primary">View More</a>
                </div>
            </div>

            <div class="row">
                @forelse($galleryImage as $key => $imageDetail)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="gallery-main">
                            <div class="gallery-item">
                                <a href="{{asset(\App\Models\Gallery::UPLOAD_PATH.'/'.$imageDetail->image)}}">
                                    <img src="{{asset(\App\Models\Gallery::UPLOAD_PATH.'/'.$imageDetail->image)}}"
                                        alt="Image" title="{{$imageDetail->title}}"></a>
                                <div class="gallery-content">
                                    <div class="gallery-inner">
                                        <h3>
                                            <a href="{{asset(\App\Models\Gallery::UPLOAD_PATH.'/'.$imageDetail->image)}}">
                                                {{ucfirst($imageDetail->title)}}
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse

                <div class="col-lg-12 mt-4">
                    <script src="https://360player.io/static/dist/scripts/embed.js" async></script>
                    <iframe width="100%" height="500" id="imageThreeD"
                            class="rounded-bottom rounded-top rounded-0 box-shadow overflow-hidden"
                            style="border: none; max-width: 100%;" frameborder="0" allowfullscreen allow=""
                            scrolling="no"
                            src=""></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery Ends -->

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
                                    <p>
                                        {!! ucfirst($value->description) !!}
                                    </p>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div class="video-outer">
                        <div class="video-content">
                            <iframe width="590" height="350" src=""
                                    title="YouTube video player"
                                    id="video"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call to Action Ends -->

    <!-- Events Starts -->
    <section class="events pb-6">
        <div class="container">
            <div class="row d-lg-flex align-items-center mb-5">
                <div class="col-lg-8">
                    <div class="section-title text-lg-left text-center mb-0">
                        <h3>Occasional Events</h3>
                        <h2>Our Recent <span>Events</span></h2>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-right text-center">
                    <a href="#" class="btn btn-primary">View More</a>
                </div>
            </div>
            <div class="row">
                @forelse($events as $key => $eventDetail)
                    <div class="col-lg-6 mb-4">
                        <div class="event-item">
                            <div class="event-content">
                                <div class="event-title clearfix">
                                    <div class="event-date">
                                        <p class="pt-2">
                                            <span>{{date('d',strtotime($eventDetail->event_start_on))}}</span> {{date('F',strtotime($eventDetail->event_start_on))}}
                                        </p>
                                    </div>
                                    <div class="event-author">
                                        <h4>{{$eventDetail->title}}</h4>
                                    </div>

                                </div>
                                <div class="event-detail pt-2">
                                    <div class="event-list">
                                        <div class="event-image mb-2">
                                            <img
                                                src="{{asset(\App\Models\Event::UPLOAD_PATH.'/Thumb-'.$eventDetail->image)}}"
                                                alt="Image">
                                        </div>
                                        <h3 class="mb-2"><a
                                                href="{{route('front.event-details',$eventDetail->id)}}">{{$eventDetail->sub_title}}</a>
                                        </h3>
                                    </div>
                                    <ul class="mt-2">
                                        <li class="mb-0 mar-right-10"><i class="fa fa-map-marker"
                                                                         aria-hidden="true"></i>{{$eventDetail->venue}}
                                        </li>
                                        <li class="mb-0"><i class="fa fa-clock-o"
                                                            aria-hidden="true"></i> {{date('M d H:i A',strtotime($eventDetail->event_start_on))}}
                                            to {{date('M d H:i A',strtotime($eventDetail->event_ends_on))}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse

            </div>
        </div>
    </section>
    <!-- Events Ends -->



    <!-- Testimonial Starts -->
    <section class="testimonial">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 col-sm-12">
                    <div class="section-title title-white m-2">
                        <h3>CLIENTS</h3>
                        <h2>Happy <span>Patients & Clients</span></h2>
                        <p>If you need any medical help we are available for you. </p>
                        {{--                        <a href="#" class="btn mt-4">View more Details <i class="fa fa-angle-right"></i></a>--}}
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
                                                <img
                                                    src="{{asset(\App\Models\Testimonial::UPLOAD_PATH.'Thumb-'.$testimonialDetail->image)}}"
                                                    alt="Image">
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
                                        <p>{!! $testimonialDetail->description!!}</p>
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
    @if($adBanner_image)
        <div id="myModals" class="modal fade in" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <a target="_blank" href="#">
                            <img src="{{$adBanner_image}}" alt="" class="img-responsive ">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('front-scripts')
    <script>
        $(document).ready(function () {


            loadImage();

            loadVideo();
            @if($adBanner_image)
            $("#myModals").modal('show');
            @endif

        });


        function loadImage(){
            $.ajax({
                type: 'GET',
                url: "{{ url('chirayu/image-360') }}",
            }).done(function(response) {
                let url = response.data;
                $('#imageThreeD').attr('src',url)
            });
        }

        function loadVideo(){
            $.ajax({
                type: 'GET',
                url: "{{ url('chirayu/video') }}",
            }).done(function(response) {
                let url = "https://www.youtube.com/embed/" +response.data;
                $('#video').attr('src',url)
            });
        }

    </script>
@endsection
