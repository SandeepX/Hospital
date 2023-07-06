<script>

    $(document).ready(function () {

        $('.error').hide();

        $('.success').hide();

        $('#appointmentTimeSection').hide();

        loadAppointmentDates();

        $('#appt_date').change(function (e){
            e.preventDefault();
            $('#appointment_time').empty();
            let date = $('#appt_date').val();
            let selectedDoctorId = $('#doctor').val();
            (date == '') ?  $('#appointmentTimeSection').hide() :  $('#appointmentTimeSection').show();
            if (selectedDoctorId && date) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('chirayu/doctor/appointment-time') }}" + '/' + selectedDoctorId + '?date='+date ,
                }).done(function(response) {
                    if(response.data.length > 0){
                        $('#appointmentTimeSection').show();
                        $('#appointment_time').append('<option value=""  selected > Select Appointment Time   </option>');
                        response.data.forEach(function(data) {
                            $('#appointment_time').append('<option value="'+data.id+'" >'+tConvert(data.time_from)+' - '+tConvert(data.time_to)+'</option>');
                        });
                    }else{
                        $('#appointmentTimeSection').hide();
                        $('#appointment_time').append('<option value=""  selected > Appointment Time Not Available </option>');
                    }
                });
            }
        })

        $('#doctorAppointmentForm').submit(function(e){
            e.preventDefault()
            let formAction = $(this).attr('action');
            let formData = $(this).serialize();
            $.ajax({
                type: "POST",
                url: formAction,
                data: formData
            }).done(function(response) {
                if(response.status_code == 200){
                    $('#patients_name').val('');
                    $('#email').val('');
                    $('#age').val('');
                    $('#gender').val('');
                    $('#contact_no').val('');
                    $('#appt_date').val('');
                    $('#appointment_time').val('');
                    $('#note').val('');
                    $('#reason').val('');

                    $('#patients_name').attr("placeholder", "Enter your name");
                    $('#email').attr("placeholder", "Enter your email address");
                    $('#age').attr("placeholder", "Enter your age");
                    $('#contact_no').attr("placeholder", "Enter contact number");
                    $('#note').attr("placeholder", "Enter notes here");
                    $('#reason').attr("placeholder", "Enter reasons here");

                    $('.success').show();
                    $('.successMessageDelete').text(response.message);
                    $('div.alert.alert-success').not('.alert-important').delay(9000).slideUp(900);
                    $('html,body').animate({
                        scrollTop: $("#showFlashMessageResponse").offset().top - 90
                    }, 300)
                }
            }).fail(function(error){
                $('.error').show();
                $('.errorMessageDelete').text(error.responseJSON.message);
                $('div.alert.alert-danger').not('.alert-important').delay(13000).slideUp(900);
                $('html,body').animate({
                    scrollTop: $("#showFlashMessageResponse").offset().top - 90
                }, 300);
            });
        });


    });

    function loadAppointmentDates(){
        $('#appointment_time').empty();
        $('#appointmentTimeSection').hide()
        $('#appt_date').empty()
        let selectedDoctorId = $('#doctor').val();
        (selectedDoctorId == null) ?  $('#appointmentDateSection').hide() : $('#appointmentDateSection').show();
        if (selectedDoctorId) {
            $.ajax({
                type: 'GET',
                url: "{{ url('chirayu/doctor/appointment-date') }}" + '/' + selectedDoctorId,
            }).done(function(response) {
                let dates = (response.data);
                if(response.data.length > 0){
                    $('#appt_date').append('<option value=""  selected >Select Appointment Date </option>');
                    dates.forEach(function (value, i) {
                        $('#appt_date').append('<option value="'+value+'" >'+value+'</option>');
                    });
                }else{
                    $('#appt_date').append('<option value=""  selected > Appointment Date Not Available   </option>');
                }
            });
        }
    }

    function tConvert (time) {
        time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
        if (time.length > 1) {
            time = time.slice (1);
            time[5] = +time[0] < 12 ? ' AM ' : ' PM';
            time[0] = +time[0] % 12 || 12; // Adjust hours
        }
        return time.join ('');
    }



</script>
