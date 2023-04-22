


<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '#showDetail', function (event) {
            event.preventDefault();
            let url = $(this).data('href');
            $.get(url, function (data) {
                console.log(data.data)
                $('.appointmentTitle').html('Appointment Detail');
                $('.name').text(data.data.patients_name);
                $('.date').text(data.data.appointment_date);
                $('.age').text(data.data.age);
                $('.gender').text(data.data.gender);
                $('.contact').text(data.data.contact_no);
                $('.department').text(data.data.department_name);
                $('.doctor').text(data.data.doctor_name);
                $('.time').text(data.data.time);
                $('.note').text(data.data.note);
                $('.reason').text(data.data.reason);
                $('#viewappoint').modal('show');
            })
        }).trigger("change");

        $('body').on('click', '#updateAppointmentStatus', function (event) {
            event.preventDefault();
            let url = $(this).data('href');
            let action = $(this).data('action');
            $.get(url, function (data) {
                let patient = data.data.name
                let appointmentStatus = data.data.status
                $('.modal-title').html('Update ' + patient + ' Appointment Request Status');
                $('#status').val(appointmentStatus)
                $('#appointmentStatusUpdate').attr('action',action);
                $('#addslider').modal('show');
            })
        }).trigger("change");



        $('.delete').click(function (event) {
            event.preventDefault();
            let href = $(this).data('href');
            Swal.fire({
                title: 'Are you sure you want to Delete this Appointment ?',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                padding:'10px 50px 10px 50px',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            })
        })

        $('.reset').click(function(event){
            event.preventDefault();
            $('#patient_name').val('');
            $('#doctor_name').val('');
            $('#contact_no').val('');
            $('#appointment_date').val('');
            $('#status').val('');
        })
    });

</script>
