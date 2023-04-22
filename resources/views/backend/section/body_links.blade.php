

<!-- core:js -->
<script src="{{asset('assets/backend/vendors/core/core.js')}}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="{{asset('assets/backend/vendors/chartjs/Chart.min.js')}}"></script>
<script src="{{asset('assets/backend/vendors/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{asset('assets/backend/vendors/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{asset('assets/backend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/backend/vendors/apexcharts/apexcharts.min.js')}}"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{asset('assets/backend/vendors/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/backend/js/template.js')}}"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="{{asset('assets/backend/js/dashboard-light.js')}}"></script>
<script src="{{asset('assets/backend/js/datepicker.js')}}"></script>
<!-- End custom js for this page -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- sweet alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('div.alert.alert-success').not('.alert-important').delay(5000).slideUp(900);
    $('div.alert.alert-danger').not('.alert-important').delay(10000).slideUp(900);
</script>
<!-- endinject -->
