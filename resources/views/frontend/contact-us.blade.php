
@extends('frontend.layouts.master')

@section('title','Contact us')

@section('main-content')

<section class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-outer text-center">
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ul>
            </nav>
            <h2>Contact Us</h2>
        </div>
    </div>
</section>

<section class="contact contact1">
    <div class="container">
        <div class="contact-inner">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="contact-detail">
                        <div class="row contact-list align-items-center">
                            <div class="col-lg-4">
                                <p class="contact white"><i class="fa fa-phone" aria-hidden="true"></i> <span>Phone No.</span> {{$hospital->phone_one ?? $hospital->phone_two ?? 'N/A'}}</p>
                            </div>
                            <div class="col-lg-4">
                                <p class="contact white"><i class="fa fa-envelope" aria-hidden="true"></i> <span>Email</span>{{$hospital->email ??'N/A'}}</p>
                            </div>
                            <div class="col-lg-4">
                                <p class="contact white"><i class="fa fa-map-marker" aria-hidden="true"></i> <span>Location</span>
                                    {{ucfirst($hospital->address)}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>Message Us</h3>
                        <h2>Drop us <span>Message</span> for any Query</h2>
                    </div>
                </div>

                <div class="col-lg-6">

                    <!-- Contact Us Map -->
                    <div class="map">
                        <div id="map">
                            <iframe id="iframeModalWindow" src="https://maps.google.com/maps?q={{$hospital->location_lat}},{{$hospital->location_long}}&t=&z=20&ie=UTF8&iwloc=&output=embed"
                                    class="chirayu_location"
                                    height="500px"
                                    width="100%"
                                    name="iframe_modal">
                            </iframe>

                        </div>
                    </div>
                    <!-- Map Ends -->
                </div>

                <div class="col-lg-6 showFlashMessageResponse">
                    <div class="alert alert-success success">
                        <p class="successMessageDelete"></p>
                    </div>

                    <div class="alert alert-danger error">
                        <p class="errorMessageDelete"></p>
                    </div>
                    <form id="contactUs" action="{{route('front.contact-us.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Name:</label>
                                <input type="text" name="name" value="{{old('name')??''}}" id="fullName" placeholder="Enter your full name" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Email:</label>
                                <input type="email" name="email" value="{{old('email') ?? ''}}" id="email" required   placeholder="abc@xyz.com" >
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Phone No.:</label>
                                <input type="text" name="phone_no" value="{{old('phone_no') ?? ''}}" id="phone" placeholder="98XXXXXX" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Address:</label>
                                <input type="text" name="location" value="{{old('location') ??''}}" id="location" placeholder="Enter your location" required>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Your Message</label>
                                <textarea name="message" required placeholder="Enter your enquiry message here" id="message" >{{old('message') ?? ''}}</textarea>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-btn">
                                    <button type="submit" class="btn"> Send Message</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('front-scripts')
<script>
    $(document).ready(function(){

        $('.error').hide();

        $('.success').hide();

        $('#contactUs').submit(function(e){
            e.preventDefault()
            let formAction = $(this).attr('action');
            let formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: formAction,
                data: formData
            }).done(function(response) {
                if(response.status_code == 200){
                    $('#fullName').val('');
                    $('#email').val('');
                    $('#phone').val("");
                    $('#location').val("");
                    $('#message').val("");
                    $('#fullName').attr("placeholder", "Enter your full name");
                    $('#email').attr("placeholder", "abc@xyz.com");
                    $('#phone').attr("placeholder", "98XXXXXX");
                    $('#location').attr("placeholder", "Enter your location");
                    $('#message').attr("placeholder", "Enter your enquiry message here");

                    $('.success').show();
                    $('.successMessageDelete').text(response.message);
                    $('div.alert.alert-success').not('.alert-important').delay(5000).slideUp(900);
                    $('html,body').animate({
                        scrollTop: $("#showFlashMessageResponse").offset().top - 70
                    }, 300)
                }
            }).fail(function(error){
                $('.error').show();
                $('.errorMessageDelete').text(error.responseJSON.message);
                $('div.alert.alert-danger').not('.alert-important').delay(9000).slideUp(900);
                $('html,body').animate({
                    scrollTop: $("#showFlashMessageResponse").offset().top - 70
                }, 300);
            });
        });

    });

</script>

@endsection

