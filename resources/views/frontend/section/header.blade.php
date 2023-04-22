<!-- Header Starts -->

<header class="main_header_area">
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content text-lg-start text-center d-lg-flex align-items-center justify-content-between pt-1 pb-0">
                <div class="contact-info pb-1">
                    <p><i class="fa fa-phone" aria-hidden="true"></i> {{$hospitalDetail?->phone_one ?? $hospitalDetail?->phone_two ?? 'N/A'}}</p>
                    <p><i class="fa fa-envelope" aria-hidden="true"></i> {{$hospitalDetail?->email}}</p>
                </div>
                <div class="header-links text-lg-start text-center float-lg-right float-none pb-1">
                    <ul>
                        <li><a href="{{($hospitalDetail->facebook_link) ?? ''}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="{{($hospitalDetail->twitter_link)??''}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="{{($hospitalDetail->insta_link)??''}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="header_menu affix-top">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-flex d-flex align-items-center justify-content-between w-100">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{route('welcome')}}">
                            <img src="{{asset(\App\Models\HospitalProfile::UPLOAD_PATH.'/Thumb-'.$hospitalDetail?->logo)}}" alt="logo1">
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav" id="responsive-menu">
                            @include('frontend.section.partial.welcome')
                            @include('frontend.section.partial.about')
                            @include('frontend.section.partial.department')
                            @include('frontend.section.partial.doctor')
                            @include('frontend.section.partial.service')
                            @include('frontend.section.partial.package')
                            @include('frontend.section.partial.career')
                            @include('frontend.section.partial.media')
                            @include('frontend.section.partial.contact')

                            <li class="dropdown submenu">
                                <a href="#search1" class="mt_search" ><i class="fa fa-search"></i></a>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </div><!-- /.container-fluid -->
            <div id="slicknav-mobile"></div>
        </nav>
    </div>
</header>
<!-- Header Ends -->

@include('frontend.section.marquee')


