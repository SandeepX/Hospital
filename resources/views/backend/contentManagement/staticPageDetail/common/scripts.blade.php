
<script src="{{asset('assets/backend/vendors/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('assets/backend/js/tinymce.js')}}"></script>

<script>
    $(document).ready(function () {

        selectedPage();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '#showDescription', function (event) {
            event.preventDefault();
            let url = $(this).data('href');
            $.get(url, function (data) {
                let description = data.data.description
                let title = data.data.title
                let subTitle = data.data.sub_title
                // let image = data.data.image,
                $('.modal-title').html('Static Page Description');
                $('#description').text(description);
                $('.title').text(title);
                $('.subTitle').text(subTitle);
                 $('.detailImage').attr('src',data.data.image);
                $('#addslider').modal('show');
            })
        }).trigger("change");

        $('.toggleStatus').change(function (event) {
            event.preventDefault();
            var status = $(this).prop('checked') === true ? 1 : 0;
            var href = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure you want to change Status of Static Page Detail ?',
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
                title: 'Are you sure you want to Delete this Static Page Detail ?',
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

        $('#page').change(function(e){
            e.preventDefault();
            let selectPage = $('#page option:selected').val();
            if(selectPage){
                if(selectPage == 1){
                    hideTitleAndSubtitle();
                }else{
                    showTitleAndSubtitle();
                }
            }
        }).trigger('change');
    });

    function selectedPage(){
        let selectPage = $('#page option:selected').val();
        if(selectPage){
            if(selectPage == 1){
                hideTitleAndSubtitle();
            }else{
                showTitleAndSubtitle();
            }
        }
    }

    function showTitleAndSubtitle(){
        $('#titleDiv').show();
        $('#subTitleDiv').show();
    }

    function hideTitleAndSubtitle(){
        $('#titleDiv').hide();
        $('#subTitleDiv').hide();
    }

</script>
