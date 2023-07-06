<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.toggleStatus').change(function (event) {
            event.preventDefault();
            var status = $(this).prop('checked') === true ? 1 : 0;
            var href = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure you want to change Status ?',
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


        $('.deleteAdditionalService').click(function (event) {
            event.preventDefault();
            let href = $(this).data('href');
            Swal.fire({
                title: 'Are you sure you want to Delete this Service Detail?',
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


        var i = 0;
        $("#addMore").click(function () {
            ++i;
            let name = 'extraService['+i+'][name]';
            let status = 'extraService['+i+'][is_active]';
            let serviceNo = i+1;
            $(
            '<div class="row" id="extraService'+i+'">'+
                '<div class="col-lg-4 mb-3">'+
                '<label for="name" class="form-label">Additional Service Name '+serviceNo+'</label>'+
                '<input type="text" class="form-control" required id="name" name='+name+' value="" autocomplete="off"  placeholder="">'+
                '</div>'+

                // '<div class="col-lg-3 mb-3">'+
                // ' <label for="exampleFormControlSelect1" class="form-label">Status</label>'+
                // '<select class="form-select" id="is_active" name='+status+'>'+
                // '<option value="" selected  disabled>Select Status</option>'+
                // '<option value="1">Active</option>'+
                // '<option value="0">Inactive</option>'+
                // '</select>'+
                // '</div>'+

                '<div class="col-lg-2 d-flex">'+
                '<div class=" mt-4">'+
                '<button type="button" class="form-control btn-danger btn-xs remove-btn"  id="'+i+'">Remove </button>'+
                '</div>'+
                '</div>'+

            '<div>'
            ).appendTo('#additionalService');
        });

        $(document).on('click', '.remove-btn', function () {
            let button_id = $(this).attr("id");
            $('#extraService'+button_id+'').remove();
        });

        $('#additionalServices').submit(function (e, params) {
            let localParams = params || {};
            if (!localParams.send) {
                e.preventDefault();
            }
            Swal.fire({
                title: 'Are you sure you want to save these Additional Hospital Service ?',
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
    });

</script>
