@extends('backend.layouts.master')
@section('title','Create Doctor Schedule')
@section('action','Create Doctor Schedule')
@section('main-content')

    <section class="content">
        @include('backend.section.flash_message')
        @include('backend.doctor.schedule.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form id="addDoctorScheduleForm" class="row forms-sample" action="{{route('doctor-schedules.store')}}"  method="POST">
                            @csrf
                            <div class="row wholeForm">
                                @if(isset($departments))
                                    <div class="col-lg-4 mb-3">
                                        <label for="" class="form-label">Department</label>
                                        <select class="form-select" name="dept_id" id="department" required>
                                            <option>Select Department</option>
                                            @foreach($departments as $key => $value)
                                                <option value="{{$value->id}} {{ !is_null(old('dept_id')) && old('dept_id') == $value->id ? 'selected' : ''}}">{{ucfirst($value->dept_name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-4 mb-3">
                                        <label for="" class="form-label">Doctor</label>
                                        <select class="form-select" name="doctor_id" id="doctor" required>

                                        </select>
                                    </div>

                                @else
                                    <div class="col-lg-4 mb-3">
                                        <label for="" class="form-label">Doctor</label>
                                        <select class="form-select" name="doctor_id" id="doctor" required>
                                            <option value="{{$doctor->id}}">{{ucfirst($doctor->full_name)}}</option>
                                        </select>
                                    </div>
                                @endif

                                <div class="col-lg-4 mb-3">
                                    <label for="" class="form-label">Week Day</label>
                                    <select class="form-select" name="available_week_day" required id="available_week_day">
                                        <option >Select Days</option>
                                        @foreach(\App\Models\DoctorSchedule::WEEKDAY as $key => $value)
                                            <option value="{{$key}}" {{ !is_null(old('available_week_day')) && old('available_week_day') == $key ? 'selected' : ''}} >{{ucfirst($value)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <p class="mb-2">Available Time</p>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <td>Time From</td>
                                            <td>Time To</td>
                                            <td>Status</td>
                                        </tr>
                                        </thead>
                                        <tbody id="doctorSchedule">
                                        <tr class="scheduleTime0">
                                            <td>
                                                <input type="time" name="scheduleTime[0][time_from]"   class="form-control" id="time_from" required>
                                            </td>
                                            <td>
                                                <input type="time" name="scheduleTime[0][time_to]"  class="form-control" id="time_to" required >
                                            </td>
                                            <td>
                                                <select class="form-select" name="scheduleTime[0][is_active]" >
                                                    <option value="1" >Active</option>
                                                    <option value="0" >Inactive</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary" id="addMore"> <i class="link-icon" data-feather="plus"></i></button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i>Add Doctor Schedule</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @include('backend.doctor.schedule.common.schedule-scripts')
@endsection
