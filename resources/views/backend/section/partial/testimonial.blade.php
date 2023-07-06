
<li class="nav-item {{ request()->routeIs('testimonials.*')  ? 'active' : '' }}">
    <a href="{{route('testimonials.index') }}" class="nav-link">
        <i class="link-icon" data-feather="pocket"></i>
        <span class="link-title">Testimonial Section</span>
    </a>
</li>
