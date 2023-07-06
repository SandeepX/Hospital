
<script src="{{asset('assets/backend/vendors/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets/backend/js/tinymce.js')}}"></script>
<script src="{{asset('assets/backend/js/imageuploadify.min.js')}}"></script>

<script>
    $(document).ready(function () {

        $("#image-uploadify").imageuploadify();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '#updateApptLimit', function (event) {
            event.preventDefault();
            let url = $(this).data('href');
            let action = $(this).data('action');
            $.get(url, function (data) {
                let fullName = data.data.full_name
                let appointmentLimit = data.data.appointment_limit
                $('.modal-title').html('Update Dr.' + fullName + ' Appointment Limit');
                $('#appointment_limit').val(appointmentLimit)
                $('#appointmentLimitUpdate').attr('action',action);
                $('#appointment_limit').val(appointmentLimit)
                $('#addslider').modal('show');
            })
        }).trigger("change");

        $('.toggleStatus').change(function (event) {
            event.preventDefault();
            let status = $(this).prop('checked') === true ? 1 : 0;
            let href = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure you want to change Doctor Status ?',
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

        $('.delete').click(function (event) {
            event.preventDefault();
            let href = $(this).data('href');
            Swal.fire({
                title: 'Are you sure you want to Delete Doctor Detail ?',
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

        let i = 0;
        let m = 0;
        $("#addAcademic").click(function () {
            let key = $(this).data('key');
            if(!isNaN(key)){
                ++m;
                i = key + m;
            }else{
               ++i;
            }
            let qualification = 'academic['+i+'][qualification]';
            let university = 'academic['+i+'][university]';
            let passedYear = 'academic['+i+'][passed_year]';
            $(
                '<tr class="singleAcademic'+i+'">'+
                    '<td>'+
                        '<input type="text" class="form-control" required id="qualifiaction" name='+qualification+' value="" autocomplete="off"  placeholder="Enter Qualification">'+
                    '</td>'+

                    '<td>'+
                        '<input type="text" class="form-control" required id="university" name='+university+' value="" autocomplete="off"  placeholder="Enter University Name">'+
                    '</td>'+

                    '<td>'+
                        '<input type="date" class="form-control" required id="passed_year" name='+passedYear+' value="" autocomplete="off"  placeholder="">'+
                    '</td>'+

                    '<td class="text-center">'+
                            '<button type="button" class="btn btn-danger btn-xs  removeAcademic" id="'+i+'">Remove </button>'+
                    '</td>'+
                '</tr>'
            ).prependTo('#academicQualification');
        });

        $(document).on('click', '.removeAcademic', function () {
            let button_id = $(this).attr("id");
            $('.singleAcademic'+button_id+'').remove();
        });


        let j = 0;
        let n = 0;
        $("#addSkill").click(function () {
            let key = $(this).data('key');
            if(!isNaN(key)){
                ++n;
                j = key + n;
            }else{
                ++j;
            }
            let skillName = 'skill['+j+'][skill_name]';
            let expertLevel = 'skill['+j+'][expertise_level]';
            $(
                '<tr class="singleSkill'+j+'">'+
                '<td>'+
                '<input type="text" class="form-control" required  name='+skillName+' value="" autocomplete="off"  placeholder=" Enter Skill">'+
                '</td>'+

                '<td>'+
                '<input type="number" step="1" min="1" max="100" class="form-control" required  name='+expertLevel+' value="" autocomplete="off"  placeholder="Rate Skill Expertise Level">'+
                '</td>'+

                '<td class="text-center">'+
                '<button type="button" class="btn btn-danger btn-xs  removeSkill" id="'+j+'">Remove</button>'+
                '</td>'+
                '</tr>'
            ).prependTo('#doctorSkills');
        });

        $(document).on('click', '.removeSkill', function () {
            let button_id = $(this).attr("id");
            $('.singleSkill'+button_id+'').remove();
        });


        let k = 0;
        let s = 0;
        $("#addExperience").click(function () {
            let key = $(this).data('key');
            if(!isNaN(key)){
                ++s;
                k = key + s;
            }else{
                ++k;
            }
            let description = 'experience['+k+'][description]';
            $(
                '<tr class="singleExperience'+k+'">'+
                '<td>'+
                '<input type="text" class="form-control" required  name='+description+' value="" autocomplete="off"  placeholder="Enter work experience description">'+
                '</td>'+

                '<td class="text-center">'+
                '<button type="button" class="btn btn-danger btn-xs removeExperience" id="'+k+'">Remove</button>'+
                '</td>'+
                '</tr>'
            ).prependTo('#workExperience');
        });

        $(document).on('click', '.removeExperience', function () {
            let button_id = $(this).attr("id");
            $('.singleExperience'+button_id+'').remove();
        });


        $('#addDoctorDetailForm').submit(function (e, params) {
            let localParams = params || {};
            if (!localParams.send) {
                e.preventDefault();
            }
            Swal.fire({
                title: 'Are you sure you want to save Doctor Detail ?',
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

        $('#editDoctorDetailForm').submit(function (e, params) {
            let localParams = params || {};
            if (!localParams.send) {
                e.preventDefault();
            }
            Swal.fire({
                title: 'Are you sure you want to Edit Doctor Detail ?',
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

        $('.reset').click(function(event){
            event.preventDefault();
            $('#name').val('');
            $('#email').val('');
            $('#phone').val('');
            $('#department').val('');
        })


    });

</script>


