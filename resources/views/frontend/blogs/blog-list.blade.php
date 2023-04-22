@extends('frontend.layouts.master')

@section('title','Blog Lists')

@section('main-content')


<section class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-outer text-center">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ucwords($pageDetail->title)}}</li>
                </ul>
            </nav>
            <h2>{{$pageDetail->title}}</h2>
        </div>
    </div>
</section>

<!-- News Starts -->
<section class="news blog-grid pad-bottom-50">
    <div class="container">
        <div class="row blog-masonry">
            @forelse($blogs as $key => $value)
                <div class="col-lg-4 col-md-6 mb-4 blog-masonry-list">
                <div class="news-item">
                    <div class="news-image">
                        <img src="{{asset(\App\Models\Blog::UPLOAD_PATH.'Thumb-'.$value->image)}}" alt="Image">
                    </div>
                    <div class="news-content">
                        <div class="news-title d-flex align-items-center mb-2">
                            <div class="news-date px-4 py-2 mr-3">
                                <p class="white" style="size: 10px;">{{date('d F',strtotime($value->created_date))}}</p>
                            </div>
                            <h3 class="mb-0"><a href="{{route('front.blog-details',$value->id)}}">{{ucfirst($value->title)}}</a></h3>
                        </div>
                        <div class="news-author mb-1">
                            <a href="#" class="link">{{ucwords($value->tags)}}</a>
                        </div>
                        <p>
                            {!! ucfirst($value->short_description) !!}
                        </p>
                        <a href="{{route('front.blog-details',$value->id)}}" class="mt-2 text-btn">Read More <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            @empty

            @endforelse

            <!-- Pagination -->
                <div class="col-lg-12">
                    <div class="pagination__wrapper text-center">
                        <ul class="pagination">
                            {{$blogs->appends($_GET)->links()}}
                        </ul>
                    </div>
                </div>



        </div>
    </div>
</section>
<!-- News Ends -->

@endsection
