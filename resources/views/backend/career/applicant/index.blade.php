
@extends('backend.layouts.master')

@section('title','Career Applicants')

@section('action','Career Applicants Listing')


@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include(('backend.career.applicant.common.breadComb'))

                <div class="search-box p-4 bg-white rounded mb-3 box-shadow">
                    <form class="forms-sample" action="{{route('career-applicants.index')}}" method="get">
                        <div class="col-lg-2 mb-4">
                            <h5>Career Applicant Filter</h5>
                        </div>
                        <div class="row align-items-center mt-2">

                            <div class="col-lg-3 col-md-3">
                                <input type="text" placeholder="search by applicant name" id="name" name="full_name" value="{{$filterParameters['full_name']}}" class="form-control">
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <input type="email" placeholder="search by email " id="email" name="email" value="{{$filterParameters['email']}}" class="form-control">
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <input type="number" placeholder="Search by phone" name="contact_no" value="{{$filterParameters['contact_no']}}" class="form-control">
                            </div>

                            <div class="col-lg-2 col-md-4 ">
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
                                    <th>Applicant Name</th>
                                    <th>Vacancy Name</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Expected Salary</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                @forelse($careerApplicants as $key => $value)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{ucfirst($value->full_name)}}</td>
                                        <td>{{($value->careerMasterDetail) ? ucfirst($value->careerMasterDetail->title):'N/A'}}</td>
                                        <td>{{($value->email)}}</td>
                                        <td>{{($value->contact_no)}}</td>
                                        <td>{{($value->expected_salary)}}</td>

                                        <td>

                                            <ul class="d-flex list-unstyled mb-0">

                                                <li class="me-2">
                                                    <a href=""
                                                       id="showDetail"
                                                       data-href="{{route('career-applicants.show',$value->id) }}"
                                                       data-id="" title="show applicant Detail">
                                                        <i class="link-icon" data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="delete"
                                                       data-href="{{route('career-applicants.delete',$value->id)}}">
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
                {{$careerApplicants->appends($_GET)->links()}}
            </div>
        </div>

    </section>

@endsection

@section('scripts')
    @include('backend.career.applicant.common.scripts')
@endsection






