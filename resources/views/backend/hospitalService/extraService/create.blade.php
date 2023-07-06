@extends('backend.layouts.master')

@section('title','Create Additional Service')

@section('action','Create Additional Service')

@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include('backend.hospitalService.extraService.common.breadComb')

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
{{--                        <form class="forms-sample" action="{{route('hospital-extra-services.store')}}"  method="POST">--}}
{{--                            @csrf--}}
{{--                            @include('backend.hospitalService.extraService.common.form')--}}
{{--                        </form>--}}

                        <form id="additionalServices" class="forms-sample" action="{{route('hospital-extra-services.store')}}"  method="POST">
                            @csrf
                            <div class="row" id="additionalService">

                                <div class="row" id="extraService0">
                                    <div class="col-lg-4 mb-3">
                                        <label for="name" class="form-label"> Additional Service Name 1</label>
                                        <input type="text" class="form-control" id="name" name="extraService[0][name]" value="" autocomplete="off" required placeholder="">
                                    </div>

{{--                                    <div class="col-lg-3 mb-3">--}}
{{--                                        <label for="exampleFormControlSelect1" class="form-label">Status</label>--}}
{{--                                        <select class="form-select" id="is_active" name="extraService[0][is_active]">--}}
{{--                                            <option value="" selected disabled>Select status</option>--}}
{{--                                            <option value="1" >Active</option>--}}
{{--                                            <option value="0" >Inactive</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}

                                    <div class="col-lg-2 d-flex">
                                        <div class="mt-4" >
                                            <button type="button" class="form-control btn-secondary btn-xs" id="addMore" >Add More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary m-2"><i class="link-icon" data-feather="plus"></i> Save </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
  @include('backend.hospitalService.extraService.common.scripts')
@endsection
