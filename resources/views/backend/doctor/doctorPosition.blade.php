@extends('backend.layouts.master')

@section('title','Doctors Position')

@section('action','Doctors Position')

@section('button')
    <a href="{{ route('doctors.index')}}">
        <button class="btn btn-primary">
            <i class="link-icon" data-feather="plus"></i>List Doctor
        </button>
    </a>
@endsection
@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include(('backend.doctor.common.breadComb'))

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form class="forms-sample" action="{{route('doctors-position.updatePosition')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">Doctor Name</div>
                                    <div class="col-6">Display Position</div>
                                </div>
                                <div id="items-1" class="list-group col items-drag-wrap pl-0 pr-0">
                                    @foreach($doctors as $value)
                                        <div id="{{$value->id}}" data-id="{{$value->id}}"
                                             class="list-group-item nested-1">
                                            <input type="hidden" value="{{$value->id}}" name="doctor_id[]">
                                            <div class="row">
                                                <div class="col-6">{{$value->full_name}}</div>
                                                <div class="col-6">{{$value->position}}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-success"> Update Position</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @include('backend.doctor.common.scripts')
    <script src="{{asset('assets/backend/js/sortable.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
    <script>
        $('#items-1').sortable({
            group: 'list',
            animation: 200,
            ghostClass: 'ghost',
        });
    </script>
@endsection






