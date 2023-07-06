@extends('backend.layouts.master')

@section('title','Add Doctor')

@section('action','Add Doctor')

@section('main-content')

    <section class="content">

        @section('styles')
            <link rel="stylesheet" href="{{asset('assets/backend/css/imageuploadify.min.css')}}">
        @endsection

        @include('backend.section.flash_message')

        @include('backend.doctor.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" id="addDoctorDetailForm" action="{{route('doctors.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="mb-2">
                                        <label for="exampleFormControlSelect1" class="form-label">Avatar *</label>
                                        <form>
                                            <input id="image-uploadify" type="file" name="avatar" accept="image/*" multiple  required/>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Full Name *</label>
                                    <input type="text" class="form-control" id="full_name" required name="full_name" value="{{old('full_name')}}" autocomplete="off" placeholder="Enter Full Name">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" autocomplete="off" placeholder="Enter Email">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Date Of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="{{old('dob')}}" autocomplete="off" >
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Select Gender</label>
                                    <select class="form-select" name="gender" id="gender">
                                        <option value="" selected disabled>Select Gender</option>
                                        @foreach(\App\Models\Doctor::GENDER as $value)
                                            <option value="{{$value}}" {{old('gender') == $value ? 'selected':'' }} >{{ucfirst($value)}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}" autocomplete="off" placeholder="Enter Address">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="text" class="form-label"> Phone No.</label>
                                    <input type="numeric" class="form-control" id="phone_no" name="phone_no" value="{{old('phone_no')}}"  autocomplete="off" placeholder=" Enter Phone Number">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Select Department *</label>
                                    <select class="form-select" name="dept_id" required id="dept_id">
                                        <option value="" selected disabled>Select Department</option>
                                        @foreach($departments as $key => $value)
                                            <option value="{{$value->id}}" {{old('dept_id') == $value->id ? 'selected':'' }} >{{ucfirst($value->dept_name)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label">Speciality *</label>
                                    <input type="text" class="form-control" id="speciality" required name="speciality" value="{{old('speciality')}}" autocomplete="off" placeholder=" Enter Speciality">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="text" class="form-label"> Experience In Year *</label>
                                    <input type="number" step="1" min="1" max="50" required name="experience_in_year" value="{{old('experience_in_year')}}" class="form-control" id="experience_in_year" autocomplete="off" placeholder="Enter Doctor Experience In Year">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Appointment Limit *</label>
                                    <input type="number" step="1" min="1" required name="appointment_limit" value="{{old('appointment_limit')}}" class="form-control" id="appointment_limit" autocomplete="off" placeholder="Enter Doctor Appointment Limit">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Facebook link</label>
                                    <input type="url" class="form-control" id="fb_link" name="fb_link" value="{{old('fb_link') }}" autocomplete="off" placeholder="Enter facebook Link">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Instagram link</label>
                                    <input type="url" class="form-control" id="insta_link" name="insta_link" value="{{  old('insta_link') }}" autocomplete="off" placeholder="Enter Instagram Link">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Twitter link</label>
                                    <input type="url" class="form-control" id="twitter_link" name="twitter_link" value="{{  old('twitter_link') }}" autocomplete="off" placeholder="Enter Twitter Link">
                                </div>


                                <div class="col-lg-12 mb-3">
                                    <label for="" class="form-label">Biography</label>
                                    <textarea class="form-control" name="bio" id="tinymceExample" value="" rows="5">{{old('bio')}}</textarea>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <p class="mb-2">Academic Qualification</p>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <td>Qualification</td>
                                            <td>University</td>
                                            <td>Passed Year</td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody id="academicQualification">

                                            <tr class="singleAcademic0">
                                                <td><input type="text" class="form-control"  name="academic[0][qualification]" value=""  placeholder="Enter Qualification"></td>
                                                <td><input type="text" class="form-control"  name="academic[0][university]" value=""  placeholder="Enter University Name"></td>
                                                <td><input type="date" class="form-control"  name="academic[0][passed_year]" value="" ></td>
                                                <td class="text-center"><button type="button" class="btn btn-primary" id="addAcademic"> Add </button></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <p class="mb-2">Skills</p>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <td>Skills</td>
                                            <td>Total Percent</td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody id="doctorSkills">
                                            <tr class="singleSkill0">
                                                <td><input type="text" name="skill[0][skill_name]" value="" class="form-control" placeholder="Enter Skill Name" ></td>
                                                <td><input type="number" min="1" max="100" step="1" name="skill[0][expertise_level]" value="" class="form-control" placeholder="Rate Skill Expertise Level "></td>

                                                <td class="text-center"><button type="button" class="btn btn-primary" id="addSkill"> Add </button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <p class="mb-2">Work Experience</p>
                                    <table class="table table-bordered">
                                        <tbody id="workExperience">
                                            <tr class="singleExperience0">
                                                <td>
                                                    <input type="text" class="form-control" name="experience[0][description]" id="title" value="" placeholder="Enter work experience description">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-primary" id="addExperience">Add</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i>Add Doctor </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>



@endsection

@section('scripts')

    @include('backend.doctor.common.scripts')

@endsection
