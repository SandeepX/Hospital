
@extends('backend.layouts.master')

@section('title','Show User Details')

@section('action','Show Users Detail')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.users.common.breadComb')
        <a style="float: right;" href="{{ route('users.edit',$userDetail->id)}}">
            <button class="btn btn-primary">
                <i class="link-icon" data-feather="edit"></i>Edit Detail
            </button>

        </a>

        <div class="d-flex align-items-center mb-2">
            <img class="wd-100 ht-100 rounded-circle" style="object-fit: cover" src="{{asset(\App\Models\User::AVATAR_UPLOAD_PATH.$userDetail->avatar)}}" alt="profile">
            <div class="text-start ms-3">
                <span class="fw-bold">{{ucfirst($userDetail->name)}}</span>
                <p class="">{{($userDetail->email)}}</p>
            </div>
        </div>


        <div class="row profile-body">
            <div class="col-lg-12">
                <div class="card rounded">
                    <div class="card-body">

                        <div class="mt-3">
                            <label class="fw-bolder mb-0 text-uppercase">Username:</label>
                            <p>{{($userDetail->username)}}</p>
                        </div>

                        <div class="mt-3">
                            <label class="fw-bolder mb-0 text-uppercase">Gender:</label>
                            <p>{{ucfirst($userDetail->gender)}}</p>
                        </div>

                        <div class="mt-3">
                            <label class="fw-bolder mb-0 text-uppercase">Address.:</label>
                            <p>{{ucfirst($userDetail->address)}}</p>
                        </div>

                        <div class="mt-3">
                            <label class="fw-bolder mb-0 text-uppercase">Phone No:</label>
                            <p>{{($userDetail->phone)}}</p>
                        </div>

                        <div class="mt-3">
                            <label class="fw-bolder mb-0 text-uppercase">Date Of Birth:</label>
                            <p>{{($userDetail->dob)}}</p>
                        </div>

                        <div class="mt-3">
                            <label class="fw-bolder mb-0 text-uppercase">Role:</label>
                            <p>{{ucfirst($userDetail->role)}}</p>
                        </div>

                        <div class="mt-3">
                            <label class="fw-bolder mb-0 text-uppercase">Designation:</label>
                            <p>{{ucfirst($userDetail->designation) ?? 'N/A'}}</p>
                        </div>

                        <div class="mt-3">
                            <label class="fw-bolder mb-0 text-uppercase">Is Active:</label>
                            <p>{{($userDetail->is_active == 1) ? 'Yes':'No'}}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-4" >
            <div class="col-lg-12">
                <div class="card rounded">
                    <div class="card-body">
                        <label class="fw-bolder mb-0 text-uppercase">Introduction:</label>
                        <textarea class="form-control" disabled id="description" rows="13">{{ucfirst($userDetail->description) ?? 'N/A'}}</textarea>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection


