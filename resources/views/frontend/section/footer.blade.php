<!-- Footer Starts -->
<footer>
    <div class="container">
        <div class="f-contact mb-4">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="f-contact-inner">
                        <div class="contact-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="contact-title">
                            <span class="white">{{$hospitalDetail?->phone_one}}, {{$hospitalDetail?->phone_two}}</span>
                            <span class="white">Have a question? call us now</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="f-contact-inner">
                        <div class="contact-icon">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <div class="contact-title">
                            <span class="white">{{$hospitalDetail?->email}}</span>
                            <span class="white">Need support? Drop us an email</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="f-contact-inner">
                        <div class="contact-icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <div class="contact-title">
                            <span class="white">{{ucwords($hospitalDetail?->address)}}</span>
                            <span class="white">You can find here</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-content">
            <div class="lower-footer pb-5">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="footer-contact mar-right-15">
                            <div class="footer-logo text-lg-left text-center mb-2">
                                <img src="{{asset(\App\Models\HospitalProfile::UPLOAD_PATH.'/Thumb-'.$hospitalDetail?->logo)}}" alt="Image">
                            </div>
                            <p>
                                {!! ucfirst($hospitalDetail?->description)  !!}
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="departments">
                            <h3>Departments</h3>
                            <ul>

                                    @foreach($departments as $key => $value)
                                        <li><a href="{{route('front.department-detail',$value->id)}}">{{ucfirst($value->dept_name)}}</a></li>
                                        @php
                                            if($loop->iteration == 5){
                                                break;
                                            }
                                        @endphp
                                    @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="facility">
                            <h3>Facilities</h3>
                            <ul>
                                @foreach($services as $key => $serviceValue)
                                    <li>
                                        <a href="{{route('front.service-detail',$serviceValue->id)}}">{{ucfirst($serviceValue->name)}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <p>Copyright © {{\Carbon\Carbon::now()->format('Y')}}  Chirayu National Hospital. Powered by <a href="https://www.cninfotech.com" target="_blank">Cyclone Nepal Info Tech</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Ends -->
