
@extends('backend.layouts.master')

@section('title','Galleries')

@section('action','Gallery Listing')

@section('styles')
    <style>
    .image-item a{
        position: absolute;
        top: 5px;
        right:16px;
        background-color: #fff;
        border-radius: 50%;
        height: 30px;
        width: 30px;
        text-align: center;
        line-height: 2.2;
        transition: all ease 0.3s;
    }

    .image-item .link-icon{
        width: 16px;
        transition: all ease 0.3s;
    }

    .image-item a:hover{
        background-color:#e82e5f;
        transition: all ease 0.3s;
    }

    .image-item a:hover .link-icon{
        color:#fff;
        transition: all ease 0.3s;
    }
</style>
@endsection

@section('button')
    <a href="{{ route('galleries.create')}}">
        <button class="btn btn-primary">
            <i class="link-icon" data-feather="plus"></i>Add Gallery Images
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
        @include(('backend.gallery.common.breadComb'))

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Is Active</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>


                                @forelse($galleries as $key => $value)
                                    <tr>
                                        <td>{{++$key}}</td>

                                        <td>{{ucfirst ($value->title) ?? 'N/A' }}</td>
                                        <td>
                                            <img  src="{{asset(\App\Models\Gallery::UPLOAD_PATH.'Thumb-'.$value->image)}}"
                                                  alt="alt" width="100" height="75" >
                                        </td>
                                        <td>
                                            <label class="switch">
                                                <input class="toggleStatus" href="{{route('galleries.toggle-status',$value->id)}}"
                                                       type="checkbox" {{($value->is_active) == 1 ?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>

                                        <td>
                                            <ul class="d-flex list-unstyled mb-0">

                                                <li class="me-2">
                                                    <a href="{{route('galleries.edit',$value->id)}}">
                                                        <i class="link-icon" data-feather="edit"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="deleteImage"
                                                       data-href="{{route('galleries.delete',$value->id)}}">
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

        <div class="row mt-3">
            <div class="dataTables_paginate">
                {{$galleries->appends($_GET)->links()}}
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    @include('backend.gallery.common.scripts')
@endsection






