@extends('frontend.layouts.master')

@section('title','Management Team')

@section('main-content')

    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Management Team</li>
                    </ul>
                </nav>
                <h2>{{$pageDetail->title ? ($pageDetail->title) : 'Our Management Team' }}</h2>
            </div>
        </div>
    </section>

    <section class="blog">
        <div class="container">
            <div class="blog-content">
                <div class="row align-items-center">
                    @forelse($teams as $key =>$value)
                    <div class="col-lg-6">
                            <div class="blog-item align-items-center"><!-- blog item -->
                                <div class="blog-image w-25">
                                    <img src="{{asset(\App\Models\Team::UPLOAD_PATH.$value->image)}}" alt="Image">
                                </div>
                                <div class="news-content w-75">
                                    <h3 class="mb-0 p-0">{{$value->name}}</h3>
                                    <p class="mb-3 green">{{ucwords($value->designation) ?? 'N/A'}}</p>
                                    <p>
                                        {!! ucfirst($value->description) ?? 'N/A' !!}
                                    </p>
                                </div>
                            </div>
                    </div>
                    @empty

                    @endforelse

                    </div>

                </div>
                <!-- Pagination -->
                    <div class="col-lg-12">
                        <div class="{{$teams->hasPages() ? 'pagination__wrapper':''}} text-center">
                            <ul class="pagination">
                                {{$teams->appends($_GET)->links()}}
                            </ul>
                        </div>
                    </div>
            </div>
        </div>
    </section>

@endsection
