


                <div class="row">
                    <div class="col-lg-6">

                        <div class="mb-3">
                            <label for="title" class="form-label"> Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ (isset($blogDetail) ? $blogDetail->title: old('title') )}}" required autocomplete="off"  placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="sub_title" class="form-label">Sub Title</label>
                            <input type="text" class="form-control" id="sub_title" name="sub_title" value="{{ (isset($blogDetail) ? $blogDetail->sub_title: old('sub_title') )}}" autocomplete="off"  placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="tags" class="form-label"> Tags </label>
                            <input type="text" class="form-control" id="tags" name="tags" value="{{ (isset($blogDetail) ? $blogDetail->tags: old('tags') )}}" autocomplete="off" required  placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="created_date" class="form-label"> Created Date </label>
                            <input type="date" class="form-control" id="created_date" name="created_date" value="{{ (isset($blogDetail) ? $blogDetail->created_date: old('created_date') )}}"  autocomplete="off" required  placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="" {{ isset($blogDetail) ? '':'selected'}} disabled>Select status</option>
                                <option value="1" {{ isset($blogDetail) && ($blogDetail->status ) == 1 ? 'selected': old('status') }}>Active</option>
                                <option value="0" {{ isset($blogDetail) && ($blogDetail->status ) == 0 ? 'selected': old('status') }}>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short Description</label>
                            <textarea class="form-control" name="short_description" id="tinymceExample" rows="6">{{ ( isset($blogDetail) ? $blogDetail->short_description: old('short_description') )}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="upload" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="image" name="image" >
                            @if(isset($blogDetail) && $blogDetail->image)
                                <img  src="{{asset(\App\Models\Blog::UPLOAD_PATH.$blogDetail->image)}}"
                                      alt="" width="150"
                                      height="150">
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="description" class="form-label ">Description</label>
                        <textarea class="form-control" name="description" id="tinymceExample" rows="6">{{ ( isset($blogDetail) ? $blogDetail->description: old('description') )}}</textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{isset($blogDetail) ? 'Update':'Create'}} </button>
                    </div>
                </div>

