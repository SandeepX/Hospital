
@extends('backend.layouts.master')

@section('title','Doctor Schedule')

@section('action','Doctor Schedule Listing')

@section('button')
    <a href="{{ route('doctor-schedules.create')}}">
        <button class="btn btn-primary">
            <i class="link-icon" data-feather="plus"></i>Add Doctor Schedule
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

        @include(('backend.doctor.schedule.common.breadComb'))

        <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
            <form class="forms-sample" action="{{route('doctor-schedules.index')}}" method="get">
                <div class="col-lg-3 mb-4">
                    <h5>Doctor Schedule Lists</h5>
                </div>
                <div class="row align-items-center">

                    <div class="col-lg-3 col-md-3">
                        <input type="text" placeholder="Search by doctor name" id="name" name="name" value="{{$filterParameters['name']}}" class="form-control">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <input type="text" placeholder="Search by doctor department" id="department" name="department" value="{{$filterParameters['department']}}" class="form-control">
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
                                    <th>Department </th>
                                    <th>Doctor Name</th>
                                    <th>Available Week Day</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @forelse($doctorSchedule as $key => $value)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td> {{ucfirst($value->department->dept_name)}}</td>
                                        <td> Dr.{{ucfirst($value->full_name)}}</td>
                                        <td>
                                           <ul>
                                               @forelse($value->scheduleDetails as $key => $weekDay)
                                                    <li>{{ucfirst(\App\Models\DoctorSchedule::WEEKDAY[$weekDay->available_week_day])}}</li>
                                                @empty
                                                   N/A
                                                @endforelse
                                           </ul>
                                        </td>

                                        <td>
                                            <ul class="d-flex list-unstyled mb-0">

                                                <li class="me-2">
                                                    <a title="Add Dr. {{ucfirst($value->full_name)}} Schedule"
                                                       href="{{route('doctor-schedules.getScheduleForm',$value->id)}}">
                                                        <i class="link-icon" data-feather="edit-2"></i>
                                                    </a>
                                                </li>

                                                <li class="me-2">
                                                    <a title="Show Dr. {{ucfirst($value->full_name)}} Schedule Detail"
                                                       href="{{route('doctor-schedules.show',$value->id)}}">
                                                        <i class="link-icon" data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="delete" title="Delete Dr. {{ucfirst($value->full_name)}} Schedule Detail"
                                                       data-href="{{route('doctor-schedules.delete',$value->id)}}">
                                                        <i class="link-icon"  data-feather="delete"></i>
                                                    </a>
                                                </li>
                                            </ul>
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
                {{$doctorSchedule->appends($_GET)->links()}}
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    @include('backend.doctor.schedule.common.schedule-scripts')
@endsection






