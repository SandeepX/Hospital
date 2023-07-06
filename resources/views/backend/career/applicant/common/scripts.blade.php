
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
                let cv_filename = data.data.cv
                let cover_letter = data.data.cover_letter
                let cv_url = data.data.cv_url
                let cover_letter_url = data.data.cover_letter_url
                let expected_salary = data.data.expected_salary
                let email = data.data.email

                $('.modal-title').html('Applicant Detail');
                $('#description').text(note);
                $('.full_name').text(name);
                $('.email').text(email);
                $('.expected_salary').text(expected_salary);
                $('#downloadLink').attr('href',cv_url);
                $('#downloadLink').data('name',cv_filename);
                $('#downloadCoverLetter').attr('href',cover_letter_url);
                $('#downloadCoverLetter').data('name',cover_letter);
                $('#addslider').modal('show');
            })
        }).trigger("change");

        $('body').on('click', '#downloadLink', function (event) {
            event.preventDefault();
            let fileUrl = $(this).attr('href');
            let fileName = $(this).data('name');
            $('<a>', {
                href: fileUrl,
                download: fileName
            })[0].click();
        });

        $('body').on('click', '#downloadCoverLetter', function (event) {
            event.preventDefault();
            let fileUrl = $(this).attr('href');
            let fileName = $(this).data('name');
            $('<a>', {
                href: fileUrl,
                download: fileName
            })[0].click();
        });

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

        $('.export').click(function(e){
           e.preventDefault();
           let url = $(this).attr('href');
           window.location.href = url;
        });

    });





</script>
