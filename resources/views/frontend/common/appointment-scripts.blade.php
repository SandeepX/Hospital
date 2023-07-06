

<script>
    $(document).ready(function () {

        $('.error').hide();

        $('.success').hide();

        loadDepartment();

        $("#appointmentScroll").click(function() {
            $('html,body').animate({
                scrollTop: $(".appointmentRequest").offset().top
            }, 2000);
        });

        $('#department').change(function(e){
            let selectedDepartmentId = $('#department option:selected').val();
            $('#doctor').empty();
            $('#appt_date').val('');
            $('#appointment_time').empty();
            $('#doctorSelectSection').hide();
            $('#appointmentDateSection').hide();
            $('#appointmentTimeSection').hide();
            if (selectedDepartmentId) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('chirayu/appointment-doctors') }}" + '/' + selectedDepartmentId ,
                }).done(function(response) {
                    $('#doctorSelectSection').show();
                    $('#doctor').append('<option value=""  selected > Select Doctor </option>');
                    response.data.forEach(function(data) {
                        $('#doctor').append('<option value="'+data.id+'" >'+capitalize(data.full_name)+'</option>');
                    });
                });
            }
        }).trigger('change');

        $('#doctor').change(function (e){
            e.preventDefault();
            $('#appointmentTimeSection').hide()
            $('#appointment_time').empty();
            $('#appt_date').empty()
            let selectedDoctorId = $('#doctor option:selected').val();
            (selectedDoctorId == null) ?  $('#appointmentDateSection').hide() : $('#appointmentDateSection').show();
            if (selectedDoctorId) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('chirayu/doctor/appointment-date') }}" + '/' + selectedDoctorId,
                }).done(function(response) {
                     let dates = (response.data);
                    $('#appointmentDateSection').show()
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
        })

        $('#appt_date').change(function (e){
            e.preventDefault();
            $('#appointment_time').empty();
            let date = $('#appt_date').val();
            let selectedDoctorId = $('#doctor option:selected').val();
            if (selectedDoctorId && date) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('chirayu/doctor/appointment-time') }}" + '/' + selectedDoctorId + '?date='+date ,
                }).done(function(response) {
                    $('#appointmentTimeSection').show()
                    if(response.data.length > 0){
                        $('#appointment_time').append('<option value=""  selected >Select Appointment Time </option>');
                        response.data.forEach(function(data) {
                            $('#appointment_time').append('<option value="'+data.id+'" >'+tConvert(data.time_from)+' - '+tConvert(data.time_to)+'</option>');
                        });
                    }else{
                        $('#appointment_time').append('<option value=""  selected > Doctor Time Not Available   </option>');
                    }
                });
            }
        })

        $('#appointmentForm').submit(function(e){
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
                    $('#department').val('');
                    $('#doctor').val('');
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

    function loadDepartment(){
        $.ajax({
            type: 'GET',
            url: "{{ url('chirayu/appointment-departments') }}",
        }).done(function(response) {
            $('#department').append('<option value=""  selected >Select Department</option>');
            response.data.forEach(function(data) {
                $('#department').append('<option  value="'+data.id+'" >'+capitalize(data.dept_name)+'</option>');
            });
        });
    }

    function loadDoctor(){
        $.ajax({
            type: 'GET',
            url: "{{ url('chirayu/doctors/list') }}",
        }).done(function(response) {
            if(response.data.length > 0) {
                $('#doctorId').append('<option value=""  selected >  Search Doctor  </option>');
                response.data.forEach(function (data) {
                    $('#doctorId').append('<option  value="' + data.id + '" >'+ capitalize(data.full_name) + '</option>');
                });
            }else{
                $('#doctorId').append('<option value=""  selected >  Doctor Detail Not Found  </option>');
            }
        });
    }

    function capitalize(str) {
        strVal = '';
        str = str.split(' ');
        for (var chr = 0; chr < str.length; chr++) {
            strVal += str[chr].substring(0, 1).toUpperCase() + str[chr].substring(1, str[chr].length) + ' '
        }
        return strVal
    }

    function tConvert (time) {
        time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
        if (time.length > 1) {
            time = time.slice (1);
            time[5] = +time[0] < 12 ? ' AM ' : ' PM ';
            time[0] = +time[0] % 12 || 12; // Adjust hours
        }
        return time.join ('');
    }

</script>
