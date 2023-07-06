


                <div class="row">
                    <div class="col-lg-6">


                        <div class="mb-3">
                            <label for="title" class="form-label">Title </label>
                            <input type="text" class="form-control" id="title" name="title"  value="{{ (isset($careerOpportunityDetail) ? $careerOpportunityDetail->title: old('title') )}}" autocomplete="off" required placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="career_designation_id" class="form-label">Designation </label>
                            <select class="form-select" id="" name="career_designation_id" required>
                                <option value="" {{ isset($careerOpportunityDetail) ? '':'selected'}} disabled>Select Designation</option>
                                @foreach($designations as $key => $value)
                                    <option value="{{ $value->id }}" {{ (isset($careerOpportunityDetail) && $careerOpportunityDetail->career_designation_id   || old('career_designation_id') == $value->id) ? 'selected': '' }} >{{ ucwords($value->name) }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="mb-3">
                            <label for="job_opening_date" class="form-label"> Job Opening Date </label>
                            <input type="date" class="form-control" id="job_opening_date" name="job_opening_date" value="{{ (isset($careerOpportunityDetail) ? $careerOpportunityDetail->job_opening_date: old('job_opening_date') )}}" autocomplete="off" required placeholder="">
                        </div>


                        <div class="mb-3">
                            <label for="job_closing_date" class="form-label">Job Closing Date </label>
                            <input type="date" class="form-control" id="job_closing_date" name="job_closing_date" value="{{ (isset($careerOpportunityDetail) ? $careerOpportunityDetail->job_closing_date: old('job_closing_date') )}}" autocomplete="off" required placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="position_type" class="form-label">Position Type</label>
                            <select class="form-select" id="position_type" name="position_type"  required>
                                <option value="" selected  disabled>Select </option>
                                @foreach(\App\Models\CareerMasterDetail::POSITION_TYPE as $value)
                                    <option value="{{$value}}" {{ isset($careerOpportunityDetail) && (($careerOpportunityDetail->position_type ) || old('position_type')) == $value ? 'selected': '' }}  >{{ucfirst($value)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="openings" class="form-label"> Openings </label>
                            <input type="number" min="0" class="form-control" id="openings" name="openings"  value="{{ (isset($careerOpportunityDetail) ? $careerOpportunityDetail->openings: old('openings') )}}" autocomplete="off" required placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label"> Address </label>
                            <input type="text"  class="form-control" id="address" name="address"  value="{{ (isset($careerOpportunityDetail) ? $careerOpportunityDetail->address: old('address') )}}" autocomplete="off" required placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="salary_offered" class="form-label"> Salary Offered </label>
                            <input type="text"  class="form-control" id="salary_offered" name="salary_offered"  value="{{ (isset($careerOpportunityDetail) ? $careerOpportunityDetail->salary_offered: old('openings') )}}" autocomplete="off"  placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value=""  disabled>---Select---</option>
                                <option value="1" {{ isset($careerOpportunityDetail) && (($careerOpportunityDetail->status) || old('status')) == 1 ? 'selected':'' }}>Active</option>
                                <option value="0" {{ isset($careerOpportunityDetail) && (($careerOpportunityDetail->status) || old('status'))  == 0 ? 'selected':'' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="upload" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="image" name="image" >
                            @if(isset($careerOpportunityDetail) && $careerOpportunityDetail->image)
                                <img  src="{{asset(\App\Models\CareerMasterDetail::UPLOAD_PATH.$careerOpportunityDetail->image)}}"
                                      alt="" width="150"
                                      height="150">
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="tinymceExample" rows="6">{{ ( isset($careerOpportunityDetail) ? $careerOpportunityDetail->description: old('description') )}}</textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{isset($careerOpportunityDetail) ? 'Update':'Create'}} </button>
                    </div>
                </div>








