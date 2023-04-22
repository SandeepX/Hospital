
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
                let note = data.data.note
                let name = data.data.full_name
                $('.modal-title').html('Applicant Detail');
                $('#description').text(note);
                $('.full_name').text(name);
                $('.cv').attr('src',data.data.cv);
                $('#addslider').modal('show');
            })
        }).trigger("change");


        $('.delete').click(function (event) {
            event.preventDefault();
            let href = $(this).data('href');
            Swal.fire({
                title: 'Are you sure you want to Delete this Applicants Career Detail?',
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

    });





</script>
