
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{route('admin')}}" class="sidebar-brand">
            <img src="{{asset('assets/backend/images/logo.png')}}" alt="logo" class="w-75">
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            @include('backend.section.partial.dashboard')
            @include('backend.section.partial.appointment')
            @if(auth()->user()->role == 'admin')
                @include('backend.section.partial.user')
                @include('backend.section.partial.hospitalManagement')
                @include('backend.section.partial.DoctorManagement')
                @include('backend.section.partial.service')
                @include('backend.section.partial.package')
                @include('backend.section.partial.contentManagement')
                @include('backend.section.partial.event')
                @include('backend.section.partial.gallery')
                @include('backend.section.partial.testimonial')
                @include('backend.section.partial.internationalPatient')
                @include('backend.section.partial.blog')
                @include('backend.section.partial.career')
                @include('backend.section.partial.contactUs')
                @include('backend.section.partial.settings')
                @include('backend.section.partial.teamMember')
            @endif




        </ul>
    </div>
</nav>
<!-- partial -->
