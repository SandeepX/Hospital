
@extends('backend.layouts.master')

@section('title','Appointments')

@section('action','Appointment Listing')


@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include(('backend.appointment.common.breadComb'))
        <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
            <form class="forms-sample" action="{{route('appointments.index')}}" method="get">
                <div class="col-lg-3 mb-3">
                    <h5>Appointment Lists</h5>
                </div>
                <div class="row align-items-center">

                    <div class="col-lg-3 col-md-3">
                        <input type="text" placeholder="Search by patient name" id="patient_name" name="patient_name" value="{{$filterParameters['patient_name']}}" class="form-control">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <input type="number" placeholder="Search by patient contact no" id="contact_no" name="contact_no" value="{{$filterParameters['contact_no']}}" class="form-control">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <input type="text" placeholder="Search by doctor name" name="doctor_name" id="doctor_name" value="{{$filterParameters['doctor_name']}}" class="form-control">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <input type="date"  name="appointment_date" id="appointment_date" value="{{$filterParameters['appointment_date']}}" class="form-control">
                    </div>

                    <div class="col-lg-3 col-md-3 mt-3">
                        <select class="form-select" id="status" name="status" >
                            <option value="">Search by status</option>
                            @foreach(\App\Models\Appointment::STATUS as $value)
                                <option value="{{$value}}" {{$filterParameters['status'] == $value ? 'selected':''}}> {{ucfirst($value)}}</option>
                            @endforeach
                        </select>
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
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Doctor</th>
                                    <th>Appointment Date</th>
                                    <th>Appointment Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <?php
                                     $status = [
                                         'pending' => 'primary',
                                         'accepted' => 'success',
                                         'rejected' => 'danger',
                                     ]
                                ?>

                                <tr>
                                @forelse($appointments as $key => $value)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{ucfirst($value->patients_name)}}</td>
                                        <td>{{($value->contact_no)}}</td>
                                        <td>{{($value->email) ?? 'N/A'}}</td>
                                        <td>{{($value->department) ? ucfirst($value->department->dept_name) :'N/A' }}</td>
                                        <td>{{($value->doctor) ? ucfirst($value->doctor->full_name) :'N/A'  }}</td>
                                        <td>{{date('M d Y',strtotime($value->appointment_date))  }}</td>
                                        <td>
                                            {{($value->appointmentTime) ? \App\Helpers\AppHelper::timeInTwelveHourFormat($value->appointmentTime->time_from): 'N/A' }} -
                                            {{($value->appointmentTime) ? \App\Helpers\AppHelper::timeInTwelveHourFormat($value->appointmentTime->time_to): 'N/A' }}
                                        </td>
                                        <td>
                                            <a href=""
                                               id="updateAppointmentStatus"
                                               data-href="{{route('appointments.edit',$value->id)}}"
                                               data-action="{{route('appointments.update-status',$value->id)}}"
                                               title="Update Appt. Status">
                                                <button class="btn btn-{{$status[$value->status]}} btn-xs">{{ucfirst($value->status) }}</button>
                                            </a>
                                        </td>

                                        <td>
                                            <ul class="d-flex list-unstyled mb-0">

                                                <li class="me-2">
                                                    <a href="#"
                                                       id="showDetail"
                                                       title="show appointment Detail"
                                                       data-href="{{route('appointments.show',$value->id) }}"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#viewappoint">
                                                        <i class="link-icon" data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="delete" title="delete"
                                                       data-href="{{route('appointments.delete',$value->id)}}">
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
                {{$appointments->appends($_GET)->links()}}
            </div>
        </div>
    </section>

    @include('backend.appointment.show')
    @include('backend.appointment.update-appt-status')
@endsection

@section('scripts')
    @include('backend.appointment.common.scripts')
@endsection






