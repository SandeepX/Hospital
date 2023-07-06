@extends('frontend.layouts.master')

@section('title','Event Detail')

@section('main-content')

<section class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-outer text-center">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('front.events')}}">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Event Detail</li>
                </ul>
            </nav>
            <h2>Event Detail</h2>
        </div>
    </div>
    <div class="overlay"></div>
</section>

<section class="blog-detail-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="detail-content">
                    <div class="section-title">
                        <h2>{{$eventDetail?->title}}</h2>
                    </div>
                    <div class="detail-image mb-2">
                        <img src="{{asset(\App\Models\Event::UPLOAD_PATH.'Thumb-'.$eventDetail?->image)}}" alt="Image">
                    </div>
                    <p>{!! $eventDetail?->description !!}</p>


                    <div class="row article-footer">
                        <div class="article-share pull-right">
                            <ul class="social d-flex">
                            <span>Share: </span>
                                <li>
                                {!! $socialShare !!}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">

                    <div class="sidebar-box">
                        <div class="sidebar-title">
                            <h3>Related Events</h3>
                        </div>
                        <ul>
                            @forelse($events as $key => $value)
                                @if($value->id != $eventDetail?->id)
                                    <div class="recent-item clearfix d-flex align-items-center">
                                        <div class="recent-image">
                                            <img src="{{asset(\App\Models\Event::UPLOAD_PATH.'Thumb-'.$value->image)}}" alt="image">
                                        </div>
                                        <div class="recent-content">
                                            <h4><a href="{{route('front.event-details',$value->id)}}">{{$value->title}}</a></h4>
                                        </div>
                                    </div>
                                @endif
                            @empty

                            @endforelse
                        </ul>
                    </div>

                    <div class="sidebar-ad">
                        <div class="ad-content">
                            <p>We are available 24/7</p>
                            <h3>Medical and Health consultant at your service</h3>
                            <a href="{{route('front.contact-us')}}" class="btn">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('front-scripts')
    <script>
        $(document).ready(function(){
            $('#social-links > ul > li:nth-child(1) > a > span').removeClass('fa-facebook-square fab fa-facebook').addClass('fa fa-facebook me-2 ');
            $('#social-links > ul > li:nth-child(1) > a').attr('title','facebook')
            $('#social-links > ul > li:nth-child(2) > a > span').removeClass('fa-twitter-square fab fa-twitter').addClass('fa fa-twitter');
            $('#social-links > ul > li:nth-child(2) > a').attr('title','Twitter')
            $('#social-links > ul > li:nth-child(3) > a > span').removeClass('fa-reddit-square fab fa-reddit').addClass('fa fa-reddit');
            $('#social-links > ul > li:nth-child(3) > a').attr('title','reddit')
            $('#social-links > ul > li:nth-child(4) > a > span').removeClass('fa-linkedin-square fab fa-linkedin').addClass('fa fa-linkedin');
            $('#social-links > ul > li:nth-child(4) > a').attr('title','linkedin')
            $('#social-links > ul > li:nth-child(5) > a > span').removeClass('fa-telegram-square fab fa-telegram').addClass('fa fa-telegram');
            $('#social-links > ul > li:nth-child(5) > a').attr('title','Telegram')
        });
    </script>

@endsection
