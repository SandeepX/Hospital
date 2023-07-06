


                <div class="row">
                    <div class="col-lg-6">

                        <div class="mb-3">
                            <label for="page" class="form-label">Page</label>
                            <select class="form-select" id="page" name="page_id" required>
                                <option value="{{old('page_id')}}"  {{isset($staticPageDetail) ? old('page_id'):'selected'}}>Select Page</option>
                                @foreach($pages as $key => $value)
                                    <option value="{{ $value->id }}" {{ (isset($staticPageDetail) && ($staticPageDetail->page_id ) == $value->id) ? 'selected':'' }} >{{ ucwords($value->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3" id="titleDiv">
                            <label for="title" class="form-label"> Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ (isset($staticPageDetail) ? $staticPageDetail->title: old('title') )}}" autocomplete="off"  placeholder="">
                        </div>

                        <div class="mb-3" id="subTitleDiv">
                            <label for="sub_title" class="form-label"> Sub Title </label>
                            <input type="text" class="form-control" id="sub_title" name="sub_title" value="{{ (isset($staticPageDetail) ? $staticPageDetail->sub_title: old('sub_title') )}}" autocomplete="off"  placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Status</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="" {{ isset($staticPageDetail) ? '':'selected'}} disabled>Select status</option>
                                <option value="1" {{ isset($staticPageDetail) && ($staticPageDetail->is_active ) == 1 ? 'selected': old('is_active') }}>Active</option>
                                <option value="0" {{ isset($staticPageDetail) && ($staticPageDetail->is_active ) == 0 ? 'selected': old('is_active') }}>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="upload" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="image" name="image" >
                            @if(isset($staticPageDetail) && $staticPageDetail->image)
                                <img  src="{{asset(\App\Models\StaticPageDetail::UPLOAD_PATH.$staticPageDetail->image)}}"
                                      alt="" width="150"
                                      height="150">
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="tinymceExample" rows="6">{{ ( isset($staticPageDetail) ? $staticPageDetail->description: old('description') )}}</textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{isset($staticPageDetail) ? 'Update':'Create'}} </button>
                    </div>
                </div>


