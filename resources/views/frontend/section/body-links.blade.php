<!-- *Scripts* -->
<script src="{{asset('assets/frontend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/plugin.js')}}"></script>
<script src="{{asset('assets/frontend/js/main.js')}}"></script>
<script src="{{asset('assets/frontend/js/custom-lightbox.js')}}"></script>
<script src="{{asset('assets/frontend/js/custom-nav.js')}}"></script>

<script>
    $('.right-sidebar-mobile').removeClass("opened");
    $('.overlay-backdrop').removeClass("show");
</script>

<script>
    function openNav() {
        $('.right-sidebar-mobile').toggleClass("opened");
        $('.right-sidebar-mobile-openbtn').toggleClass("opened");
        $('.overlay-backdrop').toggleClass("show");
    }
</script>

<script>
    $('div.alert.alert-success').not('.alert-important').delay(5000).slideUp(900);
    $('div.alert.alert-danger').not('.alert-important').delay(10000).slideUp(900);
</script>

{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
{{--<!-- sweet alert -->--}}
{{--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}

<script>
    $('div.alert.alert-success').not('.alert-important').delay(5000).slideUp(900);
    $('div.alert.alert-danger').not('.alert-important').delay(10000).slideUp(900);
</script>
<!-- endinject -->
