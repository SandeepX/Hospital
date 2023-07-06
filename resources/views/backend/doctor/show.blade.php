
@extends('backend.layouts.master')

@section('title','Show Doctor Details')

@section('action','Show Detail')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.doctor.common.breadComb')

        <div class="row">
            <div class="col-md-3 d-flex align-items-center mb-2 mb-4">
                <img class="wd-100 rounded-circle" src="{{asset(\App\Models\Doctor::UPLOAD_PATH.$doctorDetails->avatar)}}" alt="profile">
                <div class="d-inline-flex">
                    <span class="h4 ms-2 bg-white rounded p-2 px-3">{{ucfirst($doctorDetails->full_name)}}</span>
                </div>
            </div>

            <div class="col-md-3 align-items-center mb-2 mb-4">
              <strong>Email:</strong>  <span class=" ms-2 mb-3 bg-white rounded p-2 px-3">{{ucfirst($doctorDetails->email)}}</span><br>
              <strong>Date of birth:</strong>  <span class=" ms-2 mb-3 bg-white rounded p-2 px-3">{{date('M d Y', strtotime($doctorDetails->dob))}}</span><br>
              <strong>Gender:</strong>  <span class=" ms-2 mb-3 bg-white rounded p-2 px-3">{{ucfirst($doctorDetails->gender)}}</span><br>
              <strong>Phone:</strong>  <span class=" ms-2 mb-3  bg-white rounded p-2 px-3">{{($doctorDetails->phone_no)}}</span><br>
              <strong>Address:</strong>  <span class=" ms-2 mb-3  bg-white rounded p-2 px-3">{{ucfirst($doctorDetails->address)}}</span><br>
              <strong>Experience:</strong>  <span class=" ms-2 mb-3  bg-white rounded p-2 px-3">{{($doctorDetails->experience_in_year)}} Year</span><br>
            </div>

            <div class="col-md-6 align-items-center mb-2 mb-4">
                <strong>Department:</strong>  <span class=" ms-2 mb-3  bg-white rounded p-2 px-3">{{($doctorDetails->department->dept_name)}} </span><br>
                <strong>Speciality:</strong>  <span class=" ms-2 mb-3 bg-white rounded p-2 px-3">{{ucfirst($doctorDetails->speciality)}}</span><br>
                <strong>Appointment Limit:</strong>  <span class=" ms-2 mb-3  bg-white rounded p-2 px-3">{{($doctorDetails->appointment_limit)}}</span><br>
                <strong>Facebook :</strong>  <span class=" ms-2 mb-3  bg-white rounded p-2 px-3">{{($doctorDetails->fb_link)}}</span><br>
                <strong>Instagram:</strong>  <span class=" ms-2 mb-3  bg-white rounded p-2 px-3">{{($doctorDetails->insta_link)}} Year</span><br>
                <strong>Twitter:</strong>  <span class=" ms-2 mb-3  bg-white rounded p-2 px-3">{{($doctorDetails->twitter_link)}} </span><br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <strong>About :</strong><br>
                <textarea class="form-control" disabled id="doctorBio" rows="8">{{ucfirst($doctorDetails->bio)}}</textarea> <br>
            </div>
        </div>

        <div class="row profile-body">
            <div class="col-lg-12 mb-4">
                <div class="card rounded">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h4 class="card-title mb-0" style="align-content: center;">Doctor Academic Detail</h4>
                        </div>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Qualification</th>
                                    <th>University</th>
                                    <th>Passed Year</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @forelse($academics as $key => $value)
                                    <tr>
                                        <td>
                                           {{++$key}}
                                        </td>
                                        <td>{{ucfirst($value->qualification)}} </td>
                                        <td>{{ucfirst($value->university)}}</td>
                                        <td>{{date('M d Y',strtotime($value->passed_year))}}</td>
                                     </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%">
                                            <p class="text-center"><b>No records found!</b></p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12  mb-4">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h4 class="card-title mb-0" style="align-content: center;">Doctor Skill Detail</h4>
                        </div>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Skill Name</th>
                                    <th>Expertise Level(%)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @forelse($skills as $key => $value)
                                    <tr>
                                        <td>
                                            {{++$key}}
                                        </td>
                                        <td>{{ucfirst($value->skill_name)}} </td>
                                        <td>{{ucfirst($value->expertise_level)}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%">
                                            <p class="text-center"><b>No records found!</b></p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h4 class="card-title mb-0" style="align-content: center;">Doctor Work Experience</h4>
                        </div>
                        @if($experience->count()>0)
                            <ul>
                                @foreach($experience as $key => $value)
                                    <li>{{ucfirst($value->description)}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </section>
@endsection


