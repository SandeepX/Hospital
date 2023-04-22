


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
                title: 'Are you sure you want to change Status of media link ?',
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

        $('.deleteMediaLink').click(function (event) {
            event.preventDefault();
            let href = $(this).data('href');
            Swal.fire({
                title: 'Are you sure you want to Delete this media link ?',
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
            let linkType = 'media['+i+'][link_type]';
            let url = 'media['+i+'][url]';
            let status = 'media['+i+'][is_active]';
            let mediaLinkNo = i+1;
            $(
                '<div class="row" id="medialink'+i+'">'+
                    '<div class="col-lg-3 mb-3">'+
                        '<label for="link_type" class="form-label">Media Link Type  '+mediaLinkNo+'</label>'+
                        '<select class="form-select" id="link_type" required name='+linkType+' required>'+
                            '<option value=""  disabled>Select Media Link Type</option>'+
                            '<option value="image_360">360 Image</option>'+
                            '<option value="video">Video</option>'+
                        '</select>'+
                    '</div>'+

                    '<div class="col-lg-4 mb-3">'+
                        '<label for="url" class="form-label"> Media link '+mediaLinkNo+'</label>'+
                        '<input type="url" class="form-control" required id="url" name='+url+' value="" autocomplete="off"  placeholder="">'+
                    '</div>'+

                    '<div class="col-lg-3 mb-3">'+
                       ' <label for="exampleFormControlSelect1" class="form-label">Status</label>'+
                        '<select class="form-select" id="is_active" name='+status+'>'+
                            '<option value="" selected  disabled>Select Media Link Type</option>'+
                            '<option value="1">Active</option>'+
                            '<option value="0">Inactive</option>'+
                        '</select>'+
                    '</div>'+


                '<div class="col-lg-2 d-flex">'+
                        '<div class=" mt-4">'+
                            '<button type="button" class="form-control btn-danger btn-xs remove-btn"  id="'+i+'">Remove </button>'+
                        '</div>'+
                    '</div>'+

                '<div>'
            ).appendTo('#links');
        });

        $(document).on('click', '.remove-btn', function () {
            let button_id = $(this).attr("id");
            $('#medialink'+button_id+'').remove();
        });
    });



    $('#mediaLinks').submit(function (e, params) {
        let localParams = params || {};
        if (!localParams.send) {
            e.preventDefault();
        }
        Swal.fire({
            title: 'Are you sure you want to save media links ?',
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

</script>
