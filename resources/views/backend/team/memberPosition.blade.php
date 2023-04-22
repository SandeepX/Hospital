@extends('backend.layouts.master')

@section('title','Team Member Order')

@section('action','Team Member Order')

@section('button')
    <a href="{{ route('team.index')}}">
        <button class="btn btn-primary">
            <i class="link-icon" data-feather="plus"></i>List Team
        </button>
    </a>
@endsection
@section('main-content')

    <section class="content">

        @include('backend.section.flash_message')

        @include(('backend.team.common.breadComb'))

        <div class="row">
            <div class="col-md-12 mt-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive ">
                            <form class="forms-sample" action="{{route('team.updatePosition')}}" method="POST">
                                @csrf
                                <div class="row mb-2">
                                    <div class="col-6">Team Member Name</div>
                                    <div class="col-6">Display Position</div>
                                </div>
                                <div id="items-1" class="list-group col items-drag-wrap pl-0 pr-0">
                                    @foreach($teamMembers as $value)
                                        <div id="{{$value->id}}" data-id="{{$value->id}}"
                                             class="list-group-item nested-1">
                                            <input type="hidden" value="{{$value->id}}" name="teamMemberId[]">
                                            <div class="row">
                                                <div class="col-6">{{$value->name}}</div>
                                                <div class="col-6">{{$value->position}}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-success mt-4"> Update Order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @include('backend.team.common.scripts')
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






