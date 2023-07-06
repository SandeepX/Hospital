<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#department').change(function() {
            let selectedDepartmentId = $('#department option:selected').val();
            $('#doctor').empty();
            if (selectedDepartmentId) {
                $.ajax({
                    type: 'GET',
                    url: "{{ url('admin/doctor-schedules/doctors') }}" + '/' + selectedDepartmentId ,
                }).done(function(response) {
                    $('#doctor').append('<option value="" selected >--Select Doctor--</option>');
                    response.data.forEach(function(data) {
                        $('#doctor').append('<option value="'+data.id+'" > Dr. '+capitalize(data.full_name)+'</option>');
                    });
                });
            }
        }).trigger('change');

        let i = 0;
        let m = 0;
        $("#addMore").click(function () {
            let key = $(this).data('key');
            if(!isNaN(key)){
                ++m;
                i = key + m;
            }else{
                ++i;
            }
            let timeFrom = 'scheduleTime['+i+'][time_from]';
            let timeTo = 'scheduleTime['+i+'][time_to]';
            let isActive = 'scheduleTime['+i+'][is_active]';
            $(
                '<tr class="scheduleTime'+i+'">'+
                    '<td>'+
                    '   <input type="time" class="form-control" required id="time_from" name='+timeFrom+' value="" autocomplete="off"  >'+
                    '</td>'+

                    '<td>'+
                        '<input type="time" class="form-control" required id="time_to" name='+timeTo+' value="" autocomplete="off"  >'+
                    '</td>'+

                    '<td>'+
                        '<select class="form-select" name='+isActive+' >'+
                            '<option value="1">Active</option>'+
                            '<option value="0">Inactive</option>'+
                        '</select>'+
                    '</td>'+

                    '<td class="text-center">'+
                        '<button type="button" class="btn btn-danger btn-xs removeSchedule" id="'+i+'">Remove </button>'+
                    '</td>'+

                '</tr>'
            ).prependTo('#doctorSchedule');
        });

        $(document).on('click', '.removeSchedule', function () {
            let button_id = $(this).attr("id");
            $('.scheduleTime'+button_id+'').remove();
        });

        $('#addDoctorScheduleForm').submit(function (e, params) {
            let localParams = params || {};
            if (!localParams.send) {
                e.preventDefault();
            }
            Swal.fire({
                title: 'Are you sure you want to save Doctor schedule ?',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                padding:'10px 50px 10px 50px',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $(e.currentTarget).trigger(e.type, { 'send': true });
                    Swal.fire({
                        title: 'Please wait...',
                        hideClass: {
                            popup: ''
                        }
                    })
                }
            })
        });

        $('#editDoctorScheduleForm').submit(function (e, params) {
            let localParams = params || {};
            if (!localParams.send) {
                e.preventDefault();
            }
            Swal.fire({
                title: 'Are you sure you want to Edit Doctor Schedule ?',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                padding:'10px 50px 10px 50px',
                // width:'500px',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $(e.currentTarget).trigger(e.type, { 'send': true });
                    Swal.fire({
                        title: 'Please wait...',
                        hideClass: {
                            popup: ''
                        }
                    })
                }
            })
        });

        $('.delete').click(function (event) {
            event.preventDefault();
            let href = $(this).data('href');
            Swal.fire({
                title: 'Are you sure you want to Delete Doctor Schedule Detail ?',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                padding:'10px 50px 10px 50px',
                // width:'1000px',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            })
        })

        $('.updateScheduleStatus').change(function (event) {
            event.preventDefault();
            let status = $(this).prop('checked') === true ? 1 : 0;
            let href = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure you want to change Doctor Schedule Status ?',
                showDenyButton: true,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
                padding:'10px 50px 10px 50px',
                // width:'500px',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }else if (result.isDenied) {
                    (status === 0)? $(this).prop('checked', true) :  $(this).prop('checked', false)
                }
            })
        })

        $('.reset').click(function(event){
            event.preventDefault();
            $('#name').val('');
            $('#department').val('');
        })

    });

    function capitalize(str) {
        strVal = '';
        str = str.split(' ');
        for (var chr = 0; chr < str.length; chr++) {
            strVal += str[chr].substring(0, 1).toUpperCase() + str[chr].substring(1, str[chr].length) + ' '
        }
        return strVal
    }


</script>
