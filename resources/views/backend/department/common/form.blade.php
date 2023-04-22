


                <div class="row">
                    <div class="col-lg-6">

                        <div class="mb-3">
                            <label for="name" class="form-label"> Department Name</label>
                            <input type="text" class="form-control" id="name" name="dept_name" value="{{ (isset($departmentDetails) ? $departmentDetails->dept_name: old('dept_name') )}}" autocomplete="off" required placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label"> Department Opened </label>
                            <input type="date" class="form-control" id="date" name="dept_opened" value="{{ (isset($departmentDetails) ? $departmentDetails->dept_opened: old('dept_opened') )}}" autocomplete="off" placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Status</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="" {{ isset($departmentDetails) ? '':'selected'}} disabled>Select status</option>
                                <option value="1" {{ isset($departmentDetails) && ($departmentDetails->is_active ) == 1 ? 'selected': old('is_active') }}>Active</option>
                                <option value="0" {{ isset($departmentDetails) && ($departmentDetails->is_active ) == 0 ? 'selected': old('is_active') }}>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="png_class" class="form-label"> Department png Image </label>
                            <input class="form-control" type="file" id="png_class" name="png_class" >
                            @if(isset($departmentDetails) && $departmentDetails->png_class)
                                <img  src="{{asset(\App\Models\Department::UPLOAD_PATH.$departmentDetails->png_class)}}"
                                      alt="" width="150"
                                      height="150">
                            @endif
                        </div>


                        <div class="mb-3">
                            <label for="upload" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="image" name="image" >
                            @if(isset($departmentDetails) && $departmentDetails->image)
                                <img  src="{{asset(\App\Models\Department::UPLOAD_PATH.$departmentDetails->image)}}"
                                      alt="" width="150"
                                      height="150">
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="tinymceExample" rows="6">{{ ( isset($departmentDetails) ? $departmentDetails->description: old('description') )}}</textarea>
                    </div>



                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{isset($departmentDetails) ? 'Update':'Create'}} </button>
                    </div>
                </div>


