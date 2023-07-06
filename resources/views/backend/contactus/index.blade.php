
@extends('backend.layouts.master')

@section('title','Contact Us')

@section('action','Query Listing')


@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include(('backend.contactus.common.breadComb'))

        <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
            <form class="forms-sample" action="{{route('contact-us.index')}}" method="get">
                <div class="row align-items-center">

                    <div class="col-lg-3">
                        <h5>Enquiry Lists</h5>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <input type="text" placeholder="Search by name" name="name" value="{{$filterParameters['name']}}" class="form-control">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <input type="number" placeholder="Search by phone" name="phone_no" value="{{$filterParameters['phone_no']}}" class="form-control">
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <select class="form-select form-select-lg" name="is_seen" id="">
                            <option value="" {{!isset($filterParameters['is_seen']) ? 'selected': ''}} >All</option>
                                <option value="1" {{ (isset($filterParameters['is_seen']) && $filterParameters['is_seen'] == 1 ) ?'selected':'' }} >Seen Message</option>
                                <option value="0" {{ (isset($filterParameters['is_seen']) && $filterParameters['is_seen'] == 0 ) ?'selected':'' }} >Unseen Message</option>
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-4 mt-4">
                        <button type="submit" class="btn btn-block btn-primary form-control">Filter</button>
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
                                    <th>email</th>
                                    <th>Address</th>
                                    <th>phone Number</th>
                                    <th>Department</th>
                                    <th>Status</th>tatus</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $color = [
                                        0 => 'danger',
                                        1 => 'success'
                                    ];
                                ?>
                                <tr>
                                @forelse($contactUsDetail as $key => $value)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{ucfirst($value->name)}}</td>
                                        <td>{{($value->email)}}</td>
                                        <td>{{ucwords($value->location)}}</td>
                                        <td>{{($value->phone_no)}}</td>
                                        <td>{{($value->department) ? ucfirst($value->department->dept_name):'N/A'}}</td>
                                        <td><span  class="btn btn-{{$color[$value->is_seen]}} btn-xs disabled viewStatus" >{{$value->is_seen == 1 ? 'Seen':'Unseen'}}</span> </td>

                                        <td>
                                            <ul class="d-flex list-unstyled mb-0">
                                                <li class="me-2">
                                                    <a class="delete"
                                                       data-href="{{route('contact-us.delete',$value->id)}}">
                                                        <i class="link-icon"  data-feather="delete"></i>
                                                    </a>
                                                </li>

                                                <li class="me-2">
                                                    <a href=""
                                                       id="showDetail"
                                                       data-href="{{route('contact-us.show',$value->id) }}"
                                                       data-id="" title="show query">
                                                        <i class="link-icon" data-feather="eye"></i>
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
                {{$contactUsDetail->appends($_GET)->links()}}
            </div>
        </div>

    </section>


@include('backend.contactus.show')
@endsection

@section('scripts')
    @include('backend.contactus.common.scripts')
@endsection






