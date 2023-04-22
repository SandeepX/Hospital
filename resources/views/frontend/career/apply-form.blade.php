<div id="applyjob" class="modal fade in" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apply Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div id="showFlashMessageResponse">
                <div class="alert alert-success success">
                    <p class="successMessage"></p>
                </div>

                <div class="alert alert-danger error">
                    <p class="errorMessage"></p>
                </div>
            </div>
            <div class="modal-body">

                <form action="{{route('front.applicantDetail.store')}}"
                      id="applicantDetail"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" id="career_master_id"  name="career_master_id" value="{{$careerDetail->id}}" />
                        <div class="form-group col-lg-4">
                            <label>Name:</label>
                            <input id="full_name" type="text" required  name="full_name" placeholder="Enter full name"  />
                        </div>

                        <div class="form-group col-lg-4">
                            <label>Contact No.:</label>
                            <input id="contact_no" type="text" required name="contact_no" placeholder="Enter contact number" />
                        </div>
                        <div class="form-group col-lg-4">
                            <label>Expected Salary</label>
                            <input type="number" id="expected_salary" required min="1" placeholder="Enter expected salary"  name="expected_salary"/>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Email Address:</label>
                            <input id="email" type="email" required name='email' placeholder="Enter valid email"  value=""/>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Notes:</label>
                            <textarea name="note" id="note" required  rows="2" >Enter your message here</textarea>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Upload CV:</label>
                            <input class="form-control" type="file" required id="cv" name="cv" /><br>
                            <small> pdf*,doc*,docx* </small>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Upload Cover Letter:</label>
                            <input class="form-control" type="file" required id="cover_letter" name="cover_letter" /><br>
                            <small> pdf*,doc*,docx* </small>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn applicantForm">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


