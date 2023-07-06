
@extends('backend.layouts.master')

@section('title','Pages')


@section('main-content')

    <section class="content">


        @include('backend.section.flash_message')

        <nav class="page-breadcrumb d-flex align-items-center justify-content-between">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{route('admin')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Page section</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('action')</li>
            </ol>

        </nav>


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
                                    <th>Page Slug</th>
                                    <th>Is Active</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>


                                @forelse($pages as $key => $value)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{ucfirst($value->name)}}</td>
                                        <td>{{($value->slug)}}</td>
                                        <td>
                                           <span class="btn btn-success btn-xs">{{($value->is_active) == 1 ? 'Active':'Inactive'}}</span>
                                        </td>

                                        <td>
                                            <ul class="d-flex list-unstyled mb-0">

                                                <li class="me-2">
                                                    <a href="{{route('pages.edit',$value->id)}}">
                                                        <i class="link-icon" data-feather="edit"></i>
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
    </section>
@endsection







