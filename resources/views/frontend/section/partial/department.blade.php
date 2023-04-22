
<li class="submenu dropdown largemenu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Department<i class="fa fa-angle-down" aria-hidden="true"></i></a>
    <ul class="dropdown-menu">
        <li><a href="{{route('front.department')}}">All Departments</a></li>
        @forelse($departments as $key =>$value)
            <li><a href="{{route('front.department-detail',$value->id)}}">{{ucfirst($value->dept_name)}}</a></li>
        @empty

        @endforelse
    </ul>
</li>
