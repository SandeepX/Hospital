
@extends('frontend.layouts.master')

@section('title','Doctor Detail')

@section('main-content')

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
                                    <input type="number" value="" name="age" required placeholder="Enter age">
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
    <script>
        window.onload = function() {
            if(!window.location.hash) {
                window.location = window.location + '#loaded';
                window.location.reload();
            }
        }

        $(document).ready(function () {

            $('#appointmentTimeSection').hide();

            loadAppointmentDates();

            $('#appt_date').change(function (e){
                e.preventDefault();
                $('#appointment_time').empty();
                let date = $('#appt_date').val();
                let selectedDoctorId = $('#doctor').val();
                (date == '') ?  $('#appointmentTimeSection').hide() :  $('#appointmentTimeSection').show();
                if (selectedDoctorId && date) {
                    $.ajax({
                        type: 'GET',
                        url: "{{ url('chirayu/doctor/appointment-time') }}" + '/' + selectedDoctorId + '?date='+date ,
                    }).done(function(response) {
                        if(response.data.length > 0){
                            $('#appointmentTimeSection').show();
                            $('#appointment_time').append('<option value=""  selected > Select Appointment Time   </option>');
                            response.data.forEach(function(data) {
                                $('#appointment_time').append('<option value="'+data.id+'" >'+tConvert(data.time_from)+' - '+tConvert(data.time_to)+'</option>');
                            });
                        }else{
                            $('#appointmentTimeSection').hide();
                            $('#appointment_time').append('<option value=""  selected > Appointment Time Not Available </option>');
                        }
                    });
                }
            })
        });

        function loadAppointmentDates(){
            $('#appointment_time').empty();
            $('#appointmentTimeSection').hide()
            $('#appt_date').empty()
            let selectedDoctorId = $('#doctor').val();
            (selectedDoctorId == null) ?  $('#appointmentDateSection').hide() : $('#appointmentDateSection').show();
            if (selectedDoctorId) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('chirayu/doctor/appointment-date') }}" + '/' + selectedDoctorId,
                }).done(function(response) {
                    let dates = (response.data);
                    if(response.data.length > 0){
                        $('#appt_date').append('<option value=""  selected >Select Appointment Date </option>');
                        dates.forEach(function (value, i) {
                            $('#appt_date').append('<option value="'+value+'" >'+value+'</option>');
                        });
                    }else{
                        $('#appt_date').append('<option value=""  selected > Appointment Date Not Available   </option>');
                    }
                });
            }
        }

        function tConvert (time) {
            time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
            if (time.length > 1) {
                time = time.slice (1);
                time[5] = +time[0] < 12 ? ' AM ' : ' PM';
                time[0] = +time[0] % 12 || 12; // Adjust hours
            }
            return time.join ('');
        }

    </script>

@endsection
