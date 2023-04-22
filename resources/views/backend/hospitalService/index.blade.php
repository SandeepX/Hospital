
@extends('backend.layouts.master')

@section('title','Top Service')

@section('action','Top Service Listing')

@section('button')
    <a href="{{ route('hospital-services.create')}}">
        <button class="btn btn-primary">
            <i class="link-icon" data-feather="plus"></i>Add Service
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

        @include(('backend.hospitalService.common.breadComb'))


        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Service Name</th>
                                    <th>Service Started Date</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Is Quick Service</th>
                                    <th>Is Active</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>


                                @forelse($hospitalServices as $key => $value)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{ucfirst($value->name)}}</td>
                                        <td>{{date('d M Y',strtotime($value->start_date))}}</td>
                                        <td>
                                            <img  src="{{asset(\App\Models\hospitalService::UPLOAD_PATH.'Thumb-'.$value->image)}}"
                                                  alt="alt" >
                                        </td>
                                        <td>
                                            <a href=""
                                               id="showDescription"
                                               data-href="{{route('hospital-services.show',$value->id) }}"
                                               data-id="" title="show description ">
                                                <i class="link-icon" data-feather="eye"></i>
                                            </a>
                                        </td>

                                        <td>
                                            <label class="switch">
                                                <input class="toggleStatus" href="{{route('hospital-services.toggle-quick-service-status',$value->id)}}"
                                                       type="checkbox" {{($value->is_quick_services) == 1 ?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="switch">
                                                <input class="toggleStatus" href="{{route('hospital-services.toggle-status',$value->id)}}"
                                                       type="checkbox" {{($value->is_active) == 1 ?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>

                                        <td>
                                            <ul class="d-flex list-unstyled mb-0">

                                                <li class="me-2">
                                                    <a href="{{route('hospital-services.edit',$value->id)}}">
                                                        <i class="link-icon" data-feather="edit"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="deleteServiceRecord" title="delete"
                                                       data-href="{{route('hospital-services.delete',$value->id)}}">
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

{{--        <div class="row">--}}
{{--            <div class="dataTables_paginate">--}}
{{--                {{$hospitalServices->appends($_GET)->links()}}--}}
{{--            </div>--}}
{{--        </div>--}}


    </section>
    @include('backend.hospitalService.show')
@endsection

@section('scripts')
   @include('backend.hospitalService.common.scripts')
@endsection





