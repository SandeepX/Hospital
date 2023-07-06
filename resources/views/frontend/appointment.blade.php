@extends('frontend.layouts.master')

@section('title','Appointment')

@section('main-content')

    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Appointment</li>
                    </ul>
                </nav>
                <h2>Book an Appointment</h2>
            </div>
        </div>
    </section>

    <!-- Appointment Starts -->
    <section id="appointment_section" class="appointment appointment1 overflow-hidden">
        <div class="container" id="showFlashMessageResponse">
            <div class="alert alert-success success">
                <p class="successMessageDelete"></p>
            </div>

            <div class="alert alert-danger error">
                <p class="errorMessageDelete"></p>
            </div>
            <div class="row appointmentRequest">
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <div class="appointment-image">
                            <img src="{{asset('assets/frontend/images/home/appointment.png')}}" alt="image">
                        </div>
                    </div>
                    <div class="col-lg-7">

                        <div class="appointment-form">
                            <form action="{{route('front.appointment.store')}}" method="post" id="appointmentForm">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label>Name:</label>
                                        <input type="text" name="patients_name" value="" required id="patients_name"
                                               placeholder="Enter name">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Age:</label>
                                        <input type="number" value="" name="age" required id="age" placeholder="Enter age">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Gender</label>
                                        <select name="gender" required id="gender" required>
                                            <option value="">Select Gender</option>
                                            @foreach(\App\Models\Appointment::GENDER as $gender)
                                                <option value="{{$gender}}">{{ucfirst($gender)}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Contact No.:</label>
                                        <input type="text" name="contact_no" value="" required id="contact_no"
                                               placeholder="Enter contact number">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Email.:</label>
                                        <input type="email" name="email" value="" required id="email"
                                               placeholder="Enter email address">
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Specialization Department</label>
                                        <select name="dept_id" id="department" required>

                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6" id="doctorSelectSection">
                                        <label>Specialization Doctor:</label>
                                        <select name="doctor_id" id="doctor" required>

                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6" id="appointmentDateSection">
                                        <label>Appointment Request Date:</label>
                                        <select name="appointment_date"  id="appt_date" required>

                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6" id="appointmentTimeSection">
                                        <label>Doctor Appointment Time:</label>
                                        <select name="appointment_time_id" id="appointment_time" required>

                                        </select>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label>Notes:</label>
                                        <textarea name="note" required placeholder="Enter notes here"
                                                  id="note"></textarea>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Reason:</label>
                                        <textarea name="reason" required placeholder="Enter reasons here"
                                                  id="reason"></textarea>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-btn">
                                            <button class="submit btn btn-success">Book An Appointment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Appointment Ends -->

@endsection
@section('front-scripts')

    @include('frontend.common.appointment-scripts')

    <script>
        let department = $('#department').val();
        let doctor = $('#doctor').val();
        let apptDate = $('#appt_date').val();

        if(department == null){
            $('#doctorSelectSection').hide();
            $('#appointmentDateSection').hide();
            $('#appointmentTimeSection').hide();
        }else{
            $('#doctorSelectSection').show();
        }

        if(doctor == null){
            $('#appointmentDateSection').hide();
            $('#appointmentTimeSection').hide()
        }else{
            $('#appointmentDateSection').show()
        }
        (apptDate == null) ? $('#appointmentTimeSection').hide() :  $('#appointmentTimeSection').show();

    </script>

@endsection
