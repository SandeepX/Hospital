@extends('frontend.layouts.master')

@section('title','Download')

@section('main-content')

    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Download Page</li>
                    </ul>
                </nav>
                <h2>Download</h2>
            </div>
        </div>
    </section>

    <!-- Gallery Starts -->
    <section class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>File Title</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    @forelse($files as $key => $value)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>
                                                {{ucfirst($value->title)}}
                                            </td>
                                            <td class="float-right">
                                                <ul class="d-flex list-unstyled mb-0">
                                                    <li >
                                                        <a target="_blank" href="{{asset(\App\Models\Download::UPLOAD_PATH.$value->file)}}">
                                                            <button class="btn btn-xs btn-success">
                                                                <i class="fa fa-eye" aria-hidden="true"> </i> Preview
                                                            </button>
                                                        </a>
                                                    </li>

                                                    <li class="ml-2">
                                                        <a class="downloadFile" title="download file"
                                                           href="{{route('front.downloads.file-download',$value->id)}}">
                                                            <button class=" btn btn-xs btn-success"><i class="fa fa-download" aria-hidden="true"> </i> Download</button>
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
        </div>
    </section>
    <!-- download Ends -->

@endsection
