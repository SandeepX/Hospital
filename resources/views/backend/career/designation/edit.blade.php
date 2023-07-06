
@extends('backend.layouts.master')

@section('title','Edit Career Designation')

@section('action','Edit Career Designation')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.career.designation.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('career-designations.update',$careerDesignationDetail->id)}}"  method="post">
                            @method('PUT')
                            @csrf
                            <div class="row">

                                <div class="col-lg-6 mb-3">
                                    <label for="name" class="form-label"> Media link</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $careerDesignationDetail->name }}" autocomplete="off" required placeholder="">
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="" {{ isset($careerDesignationDetail) ? '':'selected'}} disabled>Select status</option>
                                        <option value="1" {{ isset($careerDesignationDetail) && ($careerDesignationDetail->status ) == 1 ? 'selected': old('status') }}>Active</option>
                                        <option value="0" {{ isset($careerDesignationDetail) && ($careerDesignationDetail->status ) == 0 ? 'selected': old('status') }}>Inactive</option>
                                    </select>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> Update </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')

    @include('backend.career.designation.common.scripts')

@endsection

