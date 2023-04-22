
@extends('frontend.layouts.master')

@section('title','Career')

@section('main-content')

<section class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-outer text-center">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Our Career</li>
                </ul>
            </nav>
            <h2>Our Career</h2>
        </div>
    </div>
</section>

<!-- News Starts -->
<section class="career pb-6">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="career-list border p-4 bg-gray">
                    <h3>Work @ Chirayu</h3>
                    <p>
                        {!! $pageDetail->description_one ?? '' !!}
                     </p>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="career-list border p-4 bg-gray">
                    <h3>Our Culture</h3>
                    <p>
                        {!! $pageDetail->description_two ?? '' !!}
                    </p>
                </div>
            </div>
            <div class="col-lg-12">
                <h3>Top Career Lists</h3>
            </div>
            @forelse($careers as $key => $value)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="career-item d-flex align-items-center box-shadow p-3 rounded-top-bottom">
                        <div class="career-image overflow-hidden mr-3">
                            <img src="{{asset(\App\Models\CareerMasterDetail::UPLOAD_PATH.'/'.$value->image)}}" alt="Image" class="w-100">
                        </div>
                        <div class="career-content w-75">
                            <h5 class="mb-0"><a href="{{route('front.careers.show',$value->id)}}">{{$value->designation->name}}</a></h5>
                            <a href="{{route('front.careers.show',$value->id)}}"class="green">{{ucfirst($value->title)}}</a>
                            <p><i>{{ucwords($value->address)}}</i></p>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-lg-12">
                    <p>Sorry there are no open vacancies available at the moment. </p>
                </div>
            @endforelse
        </div>
    </div>
</section>
<!-- News Ends -->

@endsection
