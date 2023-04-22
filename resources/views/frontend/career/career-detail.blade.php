@extends('frontend.layouts.master')

@section('title', 'Career Detail Page' )

@section('main-content')

    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page">{{ucwords($careerDetail->designation->name)}}</li>
                    </ul>
                </nav>
                <h2>{{ucfirst($careerDetail->designation->name)}}</h2>
            </div>
        </div>
    </section>

    <!-- News Starts -->
    <section class="career pb-6">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="career-main">
                        <h3 class="mb-1 border-bottom pb-1">{{$careerDetail->designation->name}}</h3>
                        <ul class="d-flex justify-content-between">
                            <li>Job posted on {{date('d M Y', strtotime($careerDetail->job_opening_date))}}</li>
                            <li>Apply before {{date('d M Y', strtotime($careerDetail->job_closing_date))}}</li>
                        </ul>
                        <h4>{{ucfirst($careerDetail->title)}}</h4>
                        <div class="career-detail-list mb-2 p-4 bg-gray border">
                            <h5> DESCRIPTION / REQUIREMENTS</h5>
                            <p>
                                {!! ucfirst($careerDetail->description) !!}
                            </p>
                        </div>

                        <div class="career-detail-list">
                            <a href="#"
                               id="applicantForm"
                               class="btn" data-toggle="modal"
                               data-target="#applyjob">Click Here to Apply</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">

                    <a href="#" class="btn w-100 mb-2"
                       id="applicantForm"
                       data-toggle="modal"
                       data-target="#applyjob">Click Here to Apply</a>

                    <div class="job-overview mb-4">
                        <h4 class="section-title mb-1">Job Overview</h4>
                        <div class="job-overview-inner border rounded-top-bottom">
                            <table class="table table-sm table-striped table-borderless">
                                <tbody>
                                <tr>
                                    <td style="min-width: 100px;">Title</td>
                                    <td><a href="#"><span>{{ucfirst($careerDetail->title)}}</span></a></td>
                                </tr>
                                <tr>
                                    <td>Openings</td>
                                    <td>{{ ($careerDetail->openings) ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Position Type</td>
                                    <td>{{ ucfirst($careerDetail->position_type) ?? ''}}</td>
                                </tr>
                                @if($careerDetail->salary_offered)
                                    <tr>
                                        <td>Salary Offered</td>
                                        <td>{{ $careerDetail->salary_offered}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Experience</td>
                                    <td><span>Please check details below.</span></td>
                                </tr>
                                <tr>
                                    <td>Education</td>
                                    <td><span>Please check details below.</span></td>
                                </tr>
                                <tr>
                                    <td>Posted Date</td>
                                    <td>{{date('d M Y', strtotime($careerDetail->job_opening_date))}}</td>
                                </tr>
                                <tr>
                                    <td>Apply Before</td>
                                    <td>{{date('d M Y', strtotime($careerDetail->job_closing_date))}}</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td><a href="#"><span>{{ucfirst($careerDetail->address)}}</span></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="job-overview mb-4">
                        <h4 class="section-title mb-1">Related Job</h4>
                        <div class="related-job">
                            @foreach($careers as $key => $value)
                                @if($value->id != $careerDetail->id)
                                    <div
                                        class="career-item d-flex align-items-center border p-3 rounded-top-bottom mb-2">
                                        <div class="career-image overflow-hidden mr-3">
                                            <img
                                                src="{{asset(\App\Models\CareerMasterDetail::UPLOAD_PATH.'Thumb-'.$value->image)}}"
                                                alt="Image" class="w-100">
                                        </div>
                                        <div class="career-content w-75">
                                            <h5 class="mb-0"><a
                                                    href="{{route('front.careers.show',$value->id)}}">{{$value->designation->name}}</a>
                                            </h5>
                                            <a href="{{route('front.careers.show',$value->id)}}"
                                               class="green">{{ucfirst($value->title)}}</a>
                                            <p><i>{{ucwords($value->address)}}</i></p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('frontend.career.apply-form')
    </section>
    <!-- News Ends -->

@endsection

@section('front-scripts')

    @include('frontend.career.common.career_scripts')

@endsection
