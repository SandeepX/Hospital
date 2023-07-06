
@extends('backend.layouts.master')

@section('title','Doctor Schedule')

@section('action','Doctor Time Table')



@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include(('backend.doctor.schedule.common.breadComb'))

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

        <div class="search-box p-2 bg-white rounded mb-3 box-shadow">
            <div class="col-lg-12 mb-4">
                <h5>Dr. {{$scheduleDetail->full_name}} Schedule Detail</h5>
            </div>
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
                                    <th>Week Day </th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @forelse($scheduleDetail->scheduleDetails as $key => $value)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>
                                           <b>{{ucfirst(\App\Models\DoctorSchedule::WEEKDAY[$value->available_week_day])}}</b>
                                        </td>

                                        <td>
                                            <ul>
                                                @forelse($value->doctorTime as $key => $time)
                                                    <li>{{\App\Helpers\AppHelper::timeInTwelveHourFormat($time->time_from)}} - {{\App\Helpers\AppHelper::timeInTwelveHourFormat($time->time_to)}}</li>
                                                @empty
                                                    N/A
                                                @endforelse
                                            </ul>
                                        </td>

                                        <td>
                                            <label class="switch">
                                                <input class="updateScheduleStatus" href="{{route('doctor-schedules.toggle-status',$value->id)}}"
                                                       type="checkbox" {{($value->is_active) == 1 ?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>

                                        <td>
                                            <a title="Edit Schedule "
                                               href="{{route('doctor-schedules.edit',$value->id)}}">
                                                <i class="link-icon" data-feather="edit"></i>
                                            </a>
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


    </section>

@endsection

@section('scripts')
    @include('backend.doctor.schedule.common.schedule-scripts')
@endsection






