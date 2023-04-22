
@extends('backend.layouts.master')

@section('title','Doctors')

@section('action','Doctor Listing')

@section('button')
    <a href="{{ route('doctors.create')}}">
        <button class="btn btn-primary">
            <i class="link-icon" data-feather="plus"></i>Add Doctor
        </button>
    </a>
@endsection

@section('main-content')

    <section class="content">

        <style>
            .box-color {
                float: left;
                height: 15px;
                width: 10px;
                padding-top: 5px;
                border: 1px solid black;
            }

            .danger-color {
                background-color:  #ff667a ;
            }

            .warning-color {
                background-color:  #f5c571 ;
            }

            .switch {
                position: relative;
                display: inline-block;
                width: 50px;
                height: 25px;
            }
            .switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }
            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #F21805;
                -webkit-transition: .4s;
                transition: .4s;
            }
            .slider:before {
                position: absolute;
                content: "";
                height: 17px;
                width: 16px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                -webkit-transition: .4s;
                transition: .4s;
            }
            input:checked + .slider {
                background-color: #50C443;
            }
            input:focus + .slider {
                box-shadow: 0 0 1px #50C443;
            }
            input:checked + .slider:before {
                -webkit-transform: translateX(26px);
                -ms-transform: translateX(26px);
                transform: translateX(26px);
            }
            /* Rounded sliders */
            .slider.round {
                border-radius: 34px;
            }
            .slider.round:before {
                border-radius: 50%;
            }
        </style>

        @include('backend.section.flash_message')

        @include(('backend.doctor.common.breadComb'))

        <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
            <form class="forms-sample" action="{{route('doctors.index')}}" method="get">
                <div class="col-lg-3 mb-4">
                    <h5>Doctor Lists</h5>
                </div>
                <div class="row align-items-center">

                    <div class="col-lg-3 col-md-3">
                        <input type="text" placeholder="Search by name" id="name" name="name" value="{{$filterParameters['name']}}" class="form-control">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <input type="email" placeholder="Search by email" id="email" name="email" value="{{$filterParameters['email']}}" class="form-control">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <input type="number" placeholder="Search by phone" id="phone" name="phone" value="{{$filterParameters['phone']}}" class="form-control">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <input type="text" placeholder="Search by department" id="department" name="department" value="{{$filterParameters['department']}}" class="form-control">
                    </div>

                    <div class="col-lg-2 col-md-4 mt-3">
                        <button type="submit" class="btn btn-block btn-primary form-control">Filter</button>
                    </div>

                    <div class="col-lg-2 col-md-4 mt-3">
                        <button type="button" class="btn btn-block btn-danger reset form-control">Reset</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Department</th>
                                    <th>Appt. Limit</th>
                                    <th>Speciality</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>


                                @forelse($doctors as $key => $value)
                                    <tr>
                                        <td>
                                           {{++$key}}
                                        </td>
                                        <td>{{ucfirst($value->full_name)}} </td>

                                        <td>{{($value->email)}}</td>
                                        <td>{{($value->phone_no)}}</td>
                                        <td>{{ucfirst($value->address)}}</td>
                                        <td>{{($value->department ? ucfirst($value->department->dept_name) : 'N/A')}}</td>
                                        <td>
                                            <a href=""
                                               id="updateApptLimit"
                                               data-href="{{route('doctors.getDoctorGeneralDetail',$value->id) }}"
                                               data-action="{{route('doctors.update-appointment-limit',$value->id)}}"
                                               title="Update Appt. Limit">
                                               <button class="btn btn-success btn-xs">{{($value->appointment_limit)}}</button>
                                            </a>

                                        </td>
                                        <td>{{ucfirst($value->speciality)}}</td>
                                        <td>
                                            <label class="switch">
                                                <input class="toggleStatus" href="{{route('doctors.toggle-status',$value->id)}}"
                                                       type="checkbox" {{($value->is_active) == 1 ?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>

                                        <td>
                                            <a class="nav-link dropdown-toggle" href="#" id="doctorDropdown"
                                               role="button"
                                               data-bs-toggle="dropdown"
                                               aria-haspopup="true"
                                               aria-expanded="false"
                                               title="More Action"
                                            ></a>

                                            <div class="dropdown-menu p-0" aria-labelledby="doctorDropdown">
                                                <ul class="list-unstyled p-1">

                                                    <li class="dropdown-item py-2">
                                                        <a class="showDoctorAllDetail"
                                                           href="{{route('doctors.getAllDoctorDetail',$value->id)}}">
                                                            <button class="btn btn-primary btn-xs">Show Doctor Detail </button>
                                                        </a>
                                                    </li>

                                                    <li class="dropdown-item py-2">
                                                        <a class="editDoctorDetail"
                                                           href="{{route('doctors.edit',$value->id)}}">
                                                            <button class="btn btn-primary btn-xs">Edit Doctor Detail </button>
                                                        </a>
                                                    </li>

                                                    <li class="dropdown-item py-2">
                                                        <a class="delete"
                                                           data-href="{{route('doctors.delete',$value->id)}}">
                                                            <button class="btn btn-primary btn-xs">Delete Doctor Detail </button>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>


                                        </td>
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
        </div>

        <div class="row">
            <div class="dataTables_paginate">
                {{$doctors->appends($_GET)->links()}}
            </div>
        </div>


    </section>
    @include('backend.doctor.update-appt-limit')
@endsection

@section('scripts')
    @include('backend.doctor.common.scripts')
@endsection






