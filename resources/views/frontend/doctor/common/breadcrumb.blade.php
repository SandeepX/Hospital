<!-- Breadcrumb Starts -->
<section class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-outer text-center">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('front.doctors')}}">Doctors</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ucwords($doctorDetails->full_name)}}</li>
                </ul>
            </nav>
            <h2>{{$doctorDetails->full_name}}</h2>
        </div>
    </div>
</section>
<!-- Breadcrumb Ends -->
