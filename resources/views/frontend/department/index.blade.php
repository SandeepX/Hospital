@extends('frontend.layouts.master')

@section('title','Departments')

@section('main-content')

    <!-- Breadcrumb Starts -->
    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Department</li>
                    </ul>
                </nav>
                <h2>Department</h2>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Ends -->

    <section class="department bg-gray pb-6">
        <div class="container">
            <div class="depart-section text-lg-left text-center">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4">
                        <div class="section-title text-right m-0">
                            <h4>HEALTH CARE FACILITY</h4>
                            <h2>Would you rather stay at home than go into a <span>health care facility?</span></h2>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="depart-section-content">                            <p>
                                {{($pageDetail->description_one) ?? $pageDetail->description_two ?? ''}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- service Starts -->
    <section class="department-services icon-left">
        <div class="container">
            <div class="row">
                @forelse($departments as $key => $value)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-icon mb-2">
                                <img  src="{{asset(\App\Models\Department::UPLOAD_PATH.'/Thumb-'.$value->png_class)}}" alt="Image">
                            </div>
                            <div class="service-content">
                                <h3>
                                    <a href="{{route('front.department-detail',$value->id)}}">{{ucfirst($value->dept_name)}}</a>
                                </h3>
                                {!! \Illuminate\Support\Str::limit($value->description, 80, $end='...') !!}
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        </div>
    </section>
    <!-- Service Ends -->

@endsection
