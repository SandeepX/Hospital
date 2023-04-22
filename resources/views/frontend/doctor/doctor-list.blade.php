@extends('frontend.layouts.master')

@section('title','Doctor Listing')

@section('main-content')

<!-- Breadcrumb Starts -->
<section class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-outer text-center">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Doctor List</li>
                </ul>
            </nav>
            <h2>Doctor Lists</h2>
        </div>
    </div>
</section>
<!-- Breadcrumb Ends -->

<!-- Specialist Starts -->
<section class="specialist team">
    <div class="sidebar">
        <div class="container">
            <div class="sidebar-box">
                <form id="searchForm" action="" role="search" method="get" class="search-form">
                    <select name="doctor" id="doctorId" >

                    </select>
                    <input type="submit" class="btn searchDoctor" value="Search">
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        @forelse($departments as $key => $departmentDetail)
            @if(count($departmentDetail->doctors) > 0)
                <div class="doctor-item">
                    <h3>{{($departmentDetail->dept_name)}}</h3>
                    <div class="row">
                        @forelse($departmentDetail->doctors as $key => $doctor)
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="special-main">
                                    <div class="special-item">
                                        <div class="special-image">
                                            <a href="{{route('front.doctor.show',$doctor->id)}}">
                                                <img src="{{asset(\App\Models\Doctor::UPLOAD_PATH.'/Thumb-'.$doctor->avatar)}}" alt="image"
                                                     style="object-fit:cover; max-height:350px; min-height: 350px; width: 100%"></a>
                                            <div class="special-links">
                                                <ul>
                                                    @if($doctor->fb_link)
                                                        <li><a href="{{$doctor->fb_link}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                    @endif
                                                    @if($doctor->insta_link)
                                                        <li><a href="{{$doctor->fb_link}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                                    @endif
                                                    @if($doctor->twitter_link)
                                                        <li><a href="{{$doctor->fb_link}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="color-overlay"></div>
                                        </div>
                                        <div class="special-content">
                                            <h4><a href="{{route('front.doctor.show',$doctor->id)}}">{{$doctor->full_name}}</a></h4>
                                            <p>{{$doctor->speciality}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty

                        @endforelse

                    </div>
                </div>
            @endif
        @empty

        @endforelse
    </div>
</section>
<!-- Specialist Ends -->

@endsection

@section('front-scripts')

    @include('frontend.common.appointment-scripts')

    <script>
        $(document).ready(function(){
            loadDoctor();
            $('.searchDoctor').click(function(e){
                e.preventDefault();
                let doctorId = $('#doctorId').val();
                let path= "{{ url('chirayu/doctors/show-detail') }}" + '/' + doctorId ;
                window.location.href = path
            })

        });
    </script>

@endsection
