@extends('backend.layouts.master')

@section('title','Edit Doctor Detail')

@section('action','Edit Doctor Detail')

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
                        <form class="forms-sample" id="editDoctorDetailForm" action="{{route('doctors.update',$doctorDetail->id)}}" enctype="multipart/form-data" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for="exampleFormControlSelect1" class="form-label">Avatar</label>
                                                <form>
                                                    <input id="image-uploadify" type="file" name="avatar"  accept="image/*" multiple />
                                                </form>
                                            </div>

                                            <div class="col-md-4 mt-4">
                                                @if( $doctorDetail->avatar)
                                                    <img  src="{{asset(\App\Models\Doctor::UPLOAD_PATH.'/Thumb-'.$doctorDetail->avatar)}}"
                                                          alt="" width="100%"
                                                    >
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Full Name</label>
                                    <input type="text" class="form-control" id="full_name"  name="full_name" value="{{$doctorDetail->full_name}}" autocomplete="off" required >
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Email Address</label>
                                    <input type="email" class="form-control" id="email"  name="email" value="{{$doctorDetail->email}}" autocomplete="off" >
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Date Of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="{{$doctorDetail->dob}}" autocomplete="off">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Select Gender</label>
                                    <select class="form-select" name="gender" required id="gender">
                                        <option value="" selected disabled>Select Gender</option>
                                        @foreach(\App\Models\Doctor::GENDER as $value)
                                            <option value="{{$value}}" {{$doctorDetail->gender == $value ? 'selected':'' }} >{{ucfirst($value)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="text" class="form-label"> Phone No.</label>
                                    <input type="numeric" class="form-control" id="phone_no" name="phone_no" value="{{$doctorDetail->phone_no}}" autocomplete="off" >
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{$doctorDetail->address}}" autocomplete="off" >
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Select Department</label>
                                    <select class="form-select" name="dept_id" required id="dept_id">
                                        <option value="" selected disabled>Select Department</option>
                                        @foreach($departments as $key => $value)
                                            <option value="{{$value->id}}" {{$value->id == $doctorDetail->dept_id ? 'selected':'' }} >{{ucfirst($value->dept_name)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label">Speciality</label>
                                    <input type="text" class="form-control" id="speciality" required name="speciality" value="{{$doctorDetail->address}}" autocomplete="off" >
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="text" class="form-label"> Experience In Year</label>
                                    <input type="number" step="1" min="1" max="50" required name="experience_in_year" value="{{$doctorDetail->experience_in_year}}" class="form-control"  autocomplete="off" >
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Appointment Limit</label>
                                    <input type="number" step="1" min="1" required name="appointment_limit" value="{{$doctorDetail->appointment_limit}}" class="form-control"  autocomplete="off" >
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Facebook link</label>
                                    <input type="text" class="form-control" id="fb_link" name="fb_link" value="{{$doctorDetail->fb_link ?? ""  }}" autocomplete="off" >
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Instagram link</label>
                                    <input type="text" class="form-control" id="insta_link" name="insta_link" value="{{$doctorDetail->insta_link ?? "" }}" autocomplete="off" >
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="" class="form-label"> Twitter link</label>
                                    <input type="text" class="form-control" id="twitter_link" name="twitter_link" value="{{$doctorDetail->twitter_link ?? ""}}" autocomplete="off" >
                                </div>


                                <div class="col-lg-12 mb-3">
                                    <label for="" class="form-label">Biography</label>
                                    <textarea class="form-control" name="bio" id="tinymceExample" rows="5">{{$doctorDetail->bio}}</textarea>
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
                                            @forelse($doctorDetail->academicDetails as $key => $value)
                                                <tr class="{{'singleAcademic'.$key}}">
                                                    <td><input type="text" class="form-control"  name="{{'academic['.$key.'][qualification]'}}" value="{{$value->qualification}}"></td>
                                                    <td><input type="text" class="form-control"  name="{{'academic['.$key.'][university]'}}" value="{{$value->university}}"></td>
                                                    <td><input type="date" class="form-control"  name="{{'academic['.$key.'][passed_year]'}}" value="{{$value->passed_year}}"></td>

                                                    @if(!$loop->last)
                                                        <td class="text-center"> <button type="button" class="btn btn-danger btn-xs removeAcademic" id="{{$key}}">Remove</button></td>
                                                    @endif

                                                    @if($loop->last)
                                                        <td class="text-center"><button type="button" class="btn btn-primary" data-key="{{$key}}" id="addAcademic"> Add </button></td>
                                                    @endif
                                                </tr>
                                            @empty
                                                <tr class="singleAcademic0">
                                                    <td><input type="text" class="form-control"  name="academic[0][qualification]" value=""  placeholder="Enter Qualification"></td>
                                                    <td><input type="text" class="form-control"  name="academic[0][university]" value=""  placeholder="Enter University Name"></td>
                                                    <td><input type="date" class="form-control"  name="academic[0][passed_year]" value="" ></td>
                                                    <td class="text-center"><button type="button" class="btn btn-primary" id="addAcademic"> Add </button></td>
                                                </tr>
                                            @endforelse
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
                                            @forelse($doctorDetail->skillDetails as $key => $value)
                                                <tr class="{{'singleSkill'.$key}}">
                                                    <td><input type="text" class="form-control" minlength="3"  name="{{'skill['.$key.'][skill_name]'}}" value="{{$value->skill_name}}"></td>
                                                    <td><input type="number" min="1" max="100" class="form-control"  name="{{'skill['.$key.'][expertise_level]'}}" value="{{$value->expertise_level}}"></td>
                                                    @if(!$loop->last)
                                                        <td class="text-center"> <button type="button" class="btn btn-danger btn-xs removeSkill" id="{{$key}}">Remove</button></td>
                                                    @endif
                                                    @if($loop->last)
                                                        <td class="text-center"><button type="button" class="btn btn-primary" data-key="{{$key}}" id="addSkill"> Add </button></td>
                                                    @endif
                                                </tr>
                                            @empty
                                                <tr class="singleSkill0">
                                                    <td><input type="text"  name="skill[0][skill_name]" minlength="3"  value="" class="form-control" placeholder="Enter Skill Name" ></td>
                                                    <td><input type="number" min="1" max="100" step="1"  name="skill[0][expertise_level]" value="" class="form-control" placeholder="Rate Skill Expertise Level "></td>
                                                    <td class="text-center"><button type="button" class="btn btn-primary" id="addSkill"> Add </button></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <p class="mb-2">Work Experience</p>
                                    <table class="table table-bordered">
                                        <tbody id="workExperience">
                                            @forelse($doctorDetail->workExperienceDetails as $key => $value)
                                                <tr class="{{'singleExperience'.$key}}">
                                                    <td><input type="text" class="form-control" minlength="10"  name="{{'experience['.$key.'][description]'}}" value="{{$value->description}}"></td>
                                                    @if(!$loop->last)
                                                        <td class="text-center"> <button type="button" class="btn btn-danger btn-xs removeExperience" id="{{$key}}">Remove</button></td>
                                                    @endif
                                                    @if($loop->last)
                                                        <td class="text-center"><button type="button" class="btn btn-primary" data-key="{{$key}}" id="addExperience"> Add </button></td>
                                                    @endif
                                                </tr>
                                            @empty
                                                <tr class="singleExperience0">
                                                    <td>
                                                        <input type="text" class="form-control"  name="experience[0][description]" id="title" value="" placeholder="Enter work experience description">
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-primary" id="addExperience">Add</button>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary"><i class="link-icon me-2" data-feather="edit"></i>Update</button>
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
