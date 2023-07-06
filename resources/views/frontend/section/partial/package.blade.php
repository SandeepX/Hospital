{{--<li class="submenu dropdown package-menu">--}}
{{--    <a href="{{route('front.package')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">--}}
{{--        Packages<i class="fa fa-angle-down" aria-hidden="true"></i>--}}
{{--    </a>--}}
{{--    <ul class="dropdown-menu">--}}
{{--        @foreach($packages as $key =>$value)--}}
{{--            <li><a href="{{route('front.package-detail',$value->id)}}">{{ucfirst($value->package_name)}}</a></li>--}}
{{--        @endforeach--}}
{{--    </ul>--}}
{{--</li>--}}

<li><a href="{{route('front.package')}}">Packages</a></li>
