
<script>
    $('.error').hide();

    $('.success').hide();

    $('#applicantDetail').submit(function(e){
        e.preventDefault()
        let formAction = $(this).attr('action');
        let formData = new FormData(this);
        $.ajax({
            url: formAction,
            type: 'post',
            data: formData,
            dataType : 'json',
            contentType: false,
            processData: false,
        }).done(function(response) {
            if(response.status_code == 200){
                $('#full_name').val('');
                $('#email').val('');
                $('#contact_no').val('');
                $('#expected_salary').val('');
                $('#note').val('');
                $('#cv').val('');
                $('#cover_letter').val('');

                $('.success').show();
                $('.successMessage').text(response.message);
                $('div.alert.alert-success').not('.alert-important').delay(5000).slideUp(600);

                setTimeout(function(){
                        $('#applyjob').modal('hide');
                    },9000
                );
            }
        }).fail(function(error){
            let errorMessage = error.responseJSON.message;
            $('.error').show();
            $('.errorMessage').text(errorMessage);
            $('div.alert.alert-danger').not('.alert-important').delay(5000).slideUp(900);
        });
    });

</script>
