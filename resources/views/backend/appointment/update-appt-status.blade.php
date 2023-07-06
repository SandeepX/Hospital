<div class="modal fade " id="addslider" tabindex="-1" aria-labelledby="addslider" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content ">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
            </div>
            <div class="modal-body">
                <form class="forms-sample" id="appointmentStatusUpdate"  action=""  method="post" >
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 mb-3" >
                            <label for="exampleFormControlSelect1" class="form-label">Appointment Status</label>
                            <select class="form-select" id="status" name="status" value="">
                                @foreach(\App\Models\Appointment::STATUS as $value)
                                    <option value="{{$value}}"> {{ucfirst($value)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" id="submit-btn" class="btn btn-primary"> Update </button>
                        </div>
                </form>

            </div>
        </div>
    </div>
</div>

