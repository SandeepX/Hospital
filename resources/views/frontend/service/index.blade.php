@extends('frontend.layouts.master')

@section('title','Services')

@section('main-content')
<!-- Breadcrumb Starts -->
    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Services</li>
                    </ul>
                </nav>
                <h2>Services</h2>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Ends -->

    <!-- Services Starts -->
    <section class="services pb-6">
        <div class="container">
            <div class="row">
                @forelse($services as $key => $value)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-icon mb-2">
                                <img src="{{asset(\App\Models\hospitalService::UPLOAD_PATH.$value->png_class)}}">
                            </div>
                            <div class="service-content">
                                <h3><a href="{{route('front.service-detail',$value->id)}}">{{($value->name)}} </a></h3>
                                 <p>{!! ucfirst(\Illuminate\Support\Str::limit($value->description, 80, $end='...'))  !!}  </p>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        </div>
    </section>
    <!-- Service Ends -->


    <section class="services pt-0">
    <div class="container">
        <div class="row">
           <div class="col-lg-12">
               <div class="section-title text-center">
                   <h2>Our Other <span>Services</span></h2>
               </div>

           </div>
            <div class="col-lg-6 col-md-6">
                <ul class="listing">
                    @forelse($additionalServices as $key => $datum)
                        <li>{{ucfirst($datum->name)}}</li>
                    @empty

                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</section>


@endsection

