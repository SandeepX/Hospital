
@extends('frontend.layouts.master')

@section('title','Doctor Detail')

@section('main-content')

@include('frontend.doctor.common.breadcrumb')

<section class="doctor-detail">
    @include('frontend.section.flash_message')
    <div class="container">
        <div class="doctor-title">
            <div class="doctor-image">
                <img src="{{asset(\App\Models\Doctor::UPLOAD_PATH.'/Thumb-'.$doctorDetails->avatar)}}" alt="Image" class="w-100">
            </div>
            <div class="doctor-title-content">
                <div class="dt-outer">
                    <h3>{{ucwords($doctorDetails->full_name)}}</h3>
                    <ul>
                        <li><strong>Department:</strong>{{ucfirst($doctorDetails->department->dept_name)}}</li>
                        <li><strong>Speciality:</strong>{{ucfirst($doctorDetails->speciality) ?? 'N/A'}}</li>
                        <li><strong>Experience:</strong> {{\App\Helpers\AppHelper::getDoctorExperienceInYear($doctorDetails->experience_in_year)}} year</li>
                        @if($doctorDetails->email)
                            <li><strong>E-mail:</strong> {{$doctorDetails->email}}</li>
                        @endif
                        @if($doctorDetails->phone_no)
                            <li><strong>Phone:</strong> {{$doctorDetails->phone_no }}</li>
                        @endif
                        @if($doctorDetails->address)
                            <li><strong>Address:</strong> {{ucwords($doctorDetails->address)}}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="doctor-content">
            <div class="row">
                <div class="col-lg-8">
                    <div class="content-outer">
                        @if($doctorDetails->bio)
                            <div class="intro content-item">
                                <div class="content-title">
                                    <h3>{{ucfirst($doctorPage->intro ?? 'INTRODUCTION' )}}</h3>
                                    <span></span>
                                </div>
                                <p>
                                    {{ucfirst($doctorDetails->bio)}}
                                </p>
                            </div>
                        @endif


                        @if(count($availableDays) > 0)
                            <div class="intro content-item">
                            <div class="content-title">
                                <h3>{{ucfirst($doctorPage->time ?? 'Available Time' )}}</h3>
                                <span></span>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td>S.N</td>
                                    <td>Day</td>
                                    <td>Time</td>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($availableDays as $key  => $weekDay)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{ucfirst(\App\Models\DoctorSchedule::WEEKDAY[$weekDay->available_week_day])}}</td>
                                        <td>
                                            <ul>
                                                @forelse($weekDay->doctorTime as $key => $time)
                                                    <li>{{\App\Helpers\AppHelper::timeInTwelveHourFormat($time->time_from)}} - {{\App\Helpers\AppHelper::timeInTwelveHourFormat($time->time_to)}}</li>
                                                @empty
                                                    <p>N/A</p>
                                                @endforelse
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Data Not found</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                        @endif

                        @if(count($academics)> 0 && !is_null($academics[0]->qualification))
                            <div class="qualification content-item">
                            <div class="content-title">
                                <h3>{{ucfirst($doctorPage->qualification ?? 'Qualification' )}} </h3>
                                <span></span>
                            </div>
                            <div class="qf-table">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td>S.N</td>
                                        <td>Qualification</td>
                                        <td>University</td>
                                        <td>Passed Year</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($academics as $key  => $academicDetail)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{ucfirst($academicDetail->qualification)}}</td>
                                            <td>{{ucfirst($academicDetail->university)}}</td>
                                            <td>{{date('Y',strtotime($academicDetail->passed_year))}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>Academic Data Not found</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                        @if(count($skills) > 0 && !is_null($skills[0]->skill_name))
                            <div class="skills content-item">
                            <div class="content-title">
                                <h3>{{ucfirst($doctorPage->skill ?? 'Skill' )}}</h3>
                                <span></span>
                            </div>

                            <div class="progress-outer">
                                @forelse($skills as $key  => $skillDetail)
                                    <div class="progress-item">
                                        <h4>{{ucfirst($skillDetail->skill_name)}}</h4>
                                        <div class="progress">
                                            <div class="progress-bar color2" role="progressbar" style="width: {{$skillDetail->expertise_level}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <span>{{$skillDetail->expertise_level}} %</span>
                                            </div>
                                        </div>
                                    </div>
                                @empty

                                @endforelse
                            </div>
                        </div>
                        @endif

                        @if(count($experience) > 0 && $experience[0]->description)
                            <div class="experience content-item">
                            <div class="content-title">
                                <h3>{{ucfirst($doctorPage->experience  ?? 'Experiences' )}}</h3>
                                <span></span>
                            </div>
                            <ul>
                                @forelse($experience as $key  => $value)
                                    <li>{{ucfirst($value->description)}}</li>
                                @empty

                                @endforelse
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="detail-sidebar">
                        <div class="sidebar-box">
                            <div class="sidebar-title">
                                <h3>{{ucfirst($doctorPage->fix_appt  ?? 'FIX APPOINTMENT' ) }}</h3>
                            </div>

                            <div class="container" id="showFlashMessageResponse">

                                <div class="alert alert-success success">
                                    <p class="successMessageDelete"></p>
                                </div>

                                <div class="alert alert-danger error">
                                    <p class="errorMessageDelete"></p>
                                </div>

                                <form class="p-4" action="{{route('front.appointment.store')}}" method="post" id="doctorAppointmentForm"  >
                                @csrf
                                <input type="hidden" name="dept_id" value="{{$doctorDetails->department->id}}" id="department" required  />
                                <input type="hidden" name="doctor_id" value="{{$doctorDetails->id}}" id="doctor" required  />

                                <div class="form-group">
                                    <label>Name:</label>
                                    <input type="text" name="patients_name" value="" required id="patients_name" placeholder="Enter name">
                                </div>

                                <div class="form-group">
                                    <label>Age:</label>
                                    <input type="number" value="" name="age" id="age" required placeholder="Enter age">
                                </div>

                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" required id="gender">
                                        <option value="">Select Gender</option>
                                        @foreach(\App\Models\Appointment::GENDER as $gender)
                                            <option value="{{$gender}}">{{ucfirst($gender)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Contact no:</label>
                                    <input type="number" name="contact_no" value="" required id="contact_no" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="text" name="email" id="email" value="" required placeholder="abc@xyz.com">
                                </div>

                                <div class="form-group">
                                    <label>Appointment Request Date:</label>
                                    <select name="appointment_date" value="" id="appt_date" required>

                                    </select>
                                </div>

                                <div class="form-group" id="appointmentTimeSection" >
                                    <label>Doctor Appointment Time:</label>
                                    <select name="appointment_time_id" id="appointment_time" required>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Notes:</label>
                                    <textarea name="note" required placeholder="Enter notes here" id="note"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Reason:</label>
                                    <textarea name="reason" required placeholder="Enter reasons here"  id="reason"></textarea>
                                </div>

                                <div class="form-group">
                                    <div class="form-btn text-center">
                                        <button class="submit btn btn-success">Book Appointment</button>
                                    </div>
                                </div>
                            </form>

                            </div>
                        </div>

                        <div class="sidebar-ad">
                            <div class="ad-content">
                                <p>We are available 24/7</p>
                                <h3>Medical and Health consultant at your service</h3>
                                <a href="{{route('front.contact-us')}}" class="btn"> Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('front-scripts')
   @include('frontend.doctor.common.scripts')
@endsection
