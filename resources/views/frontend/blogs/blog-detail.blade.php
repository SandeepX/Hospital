@extends('frontend.layouts.master')

@section('title','Blog Detail')

@section('main-content')


    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('front.blogs')}}">Blogs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog Detail</li>
                    </ul>
                </nav>
                <h2>Blog Detail</h2>
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
                        <h2>{{$blogDetail->title}}</h2>
                        <div class="post-detail">
                            <p><i class="fa fa-clock-o"></i>{{date('M d Y',strtotime($blogDetail->created_date))}}</p>
                            <p><i class="fa fa-user"></i> {{ucfirst($blogDetail->createdBy->name)}}</p>
                        </div>
                    </div>
                    <div class="detail-image mb-2">
                        <img src="{{asset(\App\Models\Blog::UPLOAD_PATH.$blogDetail->image)}}" alt="Image">
                    </div>
                    <p>
                        {!! $blogDetail->description !!}
                    </p>

                    <div class="article-footer">
                        <div class="article-tags pull-left">
                            <span><i class="fa fa-bookmark"></i></span>
                            <a href="#">{{ucwords($blogDetail->tags)}}</a>
                        </div>

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

            </div>
            <div class="col-lg-4">
                <div class="sidebar">

                    <div class="sidebar-box">
                        <div class="sidebar-title">
                            <h3>Recent Posts</h3>
                        </div>
                        @forelse($blogs as $key => $value)
                            @if($value->id != $blogDetail->id)
                            <div class="recent-item clearfix d-flex align-items-center">
                                <div class="recent-image">
                                    <img src="{{asset(\App\Models\Blog::UPLOAD_PATH.'Thumb-'.$value->image)}}" alt="image">
                                </div>
                                <div class="recent-content">
                                    <h4><a href="{{route('front.blog-details',$value->id)}}">How much aspirin to take for stroke</a></h4>
                                    <div class="post-detail mt-1">
                                        <p class="mr-2"><i class="fa fa-clock-o"></i> {{date('M d Y',strtotime($value->created_date))}}</p>
                                        <p><i class="fa fa-user"></i> {{ucfirst($value->createdBy->name)}}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @empty

                        @endforelse

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
