@extends('frontend.layouts.master')

@section('title','Event Lists')

@section('main-content')

<!-- Breadcrumb Starts -->
<section class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-outer text-center">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ucwords($pageDetail?->page?->title) ?? ''}}</li>
                </ul>
            </nav>
            <h2>{{$pageDetail?->page?->title ?? ''}}</h2>
        </div>
    </div>
</section>
<!-- Breadcrumb Ends -->

<section class="department bg-gray pb-6">
    <div class="container">
        <div class="depart-section text-lg-left text-center">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="section-title text-right m-0">
                        <h4>{{$pageDetail?->title ?? ''}}</h4>
                        <h2>{{$pageDetail?->sub_title ?? ''}} <span>health care facility?</span></h2>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="depart-section-content">
                        <p>
                            {!! ucfirst($pageDetail?->description) ?? ''  !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Events Starts -->
<section class="events">
    <div class="container">
        <div class="row">
            @foreach($events as $key => $eventDetail)
                <div class="col-lg-6 mb-4">
                    <div class="event-item">
                        <div class="event-content">
                            <div class="event-title clearfix">
                                <div class="event-date">
                                    <p class="pt-2"><span>{{date('d',strtotime($eventDetail->event_start_on))}}</span> {{date('F',strtotime($eventDetail->event_start_on))}}</p>
                                </div>
                                <div class="event-author">
                                    <h4>{{$eventDetail->title ?? ''}}</h4>
                                </div>

                            </div>
                            <div class="event-detail pt-2">
                                <div class="event-list">
                                    <div class="event-image mb-2">
                                        <img src="{{asset(\App\Models\Event::UPLOAD_PATH.'/'.$eventDetail->image)}}" alt="Image">
                                    </div>
                                    <h3 class="mb-2"><a href="{{route('front.event-details',$eventDetail->id)}}">{{$eventDetail->sub_title}}</a></h3>
                                </div>
                                <ul class="mt-2">
                                    <li class="mb-0 mar-right-10"><i class="fa fa-map-marker" aria-hidden="true"></i>{{$eventDetail->venue}}</li>
                                    <li class="mb-0"><i class="fa fa-clock-o" aria-hidden="true"></i> {{date('M d H:i A',strtotime($eventDetail->event_start_on))}} to {{date('M d H:i A',strtotime($eventDetail->event_ends_on))}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


                @if($events->count() == 10)
                    <!-- Pagination -->
                    <div class="col-lg-12">
                        <div class="pagination__wrapper text-center">
                            <ul class="pagination">
                                {{$events->appends($_GET)->links()}}
                            </ul>
                        </div>
                    </div>
                @endif

        </div>
    </div>
</section>
<!-- Events Ends -->

@endsection

