<div class="modal fade " id="addslider" tabindex="-1" aria-labelledby="addslider" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
            </div>
            <div class="modal-body">
                <form class="forms-sample" id="appointmentLimitUpdate"  action=""  method="post" >
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-3" >
                            <label for="name" class="form-label"> Appointment Limit </label>
                            <input type="number" min="1" class="form-control" id="appointment_limit" name="appointment_limit" value="" autocomplete="off" placeholder="">
                        </div>

                    <div class="text-center">
                        <button type="submit" id="submit-btn" class="btn btn-primary"> Update </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

