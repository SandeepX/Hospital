
@extends('backend.layouts.master')

@section('title','Edit Schedule Detail')

@section('action','Edit Schedule')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.doctor.schedule.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" id="editDoctorScheduleForm" action="{{route('doctor-schedules.update',$scheduleDetail->id)}}"  method="post">
                            @method('PUT')
                            @csrf
                            <div class="row wholeForm">
                                <div class="col-lg-4 mb-3">
                                    <label for="" class="form-label">Doctor</label>
                                    <select class="form-select" name="doctor_id" id="doctor" required>
                                        <option value="{{$scheduleDetail->doctor->id}}">{{ucfirst($scheduleDetail->doctor->full_name)}}</option>
                                    </select>
                                </div>

                                <div class="col-lg-4 mb-3">
                                    <label for="" class="form-label">Week Day</label>
                                    <select class="form-select" name="available_week_day" required id="available_week_day">
                                        <option value="">Select Days</option>
                                        @foreach(\App\Models\DoctorSchedule::WEEKDAY as $key => $value)
                                            <option value="{{$key}}" {{ $scheduleDetail->available_week_day == $key ? 'selected' : ''}} >{{ucfirst($value)}}</option>
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
                                            @forelse($scheduleDetail->doctorTime as $key => $value)
                                                <tr class="{{'scheduleTime'.$key}}">
                                                    <td><input type="time" class="form-control" required name="{{'scheduleTime['.$key.'][time_from]'}}" value="{{\App\Helpers\AppHelper::timeInTwentyFourHourFormat($value->time_from)}}"></td>
                                                    <td><input type="time" class="form-control" required name="{{'scheduleTime['.$key.'][time_to]'}}" value="{{\App\Helpers\AppHelper::timeInTwentyFourHourFormat($value->time_to)}}"></td>
                                                    <td>
                                                        <select class="form-select" name={{'scheduleTime['.$key.'][is_active]'}} value="">
                                                                <option value="1" {{ isset($value->is_active) && $value->is_active == 1? 'selected':'' }}>Active</option>
                                                                <option value="0" {{ isset($value->is_active) && $value->is_active == 0? 'selected':'' }}>Inactive</option>
                                                        </select>
                                                    </td>

                                                    @if(!$loop->last)
                                                        <td class="text-center"> <button type="button" class="btn btn-danger btn-xs removeSchedule" id="{{$key}}">Remove</button></td>
                                                    @endif

                                                    @if($loop->last)
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-primary" data-key="{{$key}}" id="addMore"> <i class="link-icon" data-feather="plus"></i> </button>
                                                        </td>
                                                    @endif
                                                </tr>

                                            @empty
                                                <tr class="scheduleTime0">
                                                    <td>
                                                        <input type="time" name="scheduleTime[0][time_from]" value=""   class="form-control" id="time_from" required>
                                                    </td>
                                                    <td>
                                                        <input type="time" name="scheduleTime[0][time_to]" value="" class="form-control" id="time_to" required >
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
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i>Update Doctor Schedule</button>
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

