


                <div class="row">
                    <div class="col-lg-6">

                        <div class="mb-3">
                            <label for="name" class="form-label"> Service Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ (isset($hospitalServiceDetail) ? $hospitalServiceDetail->name: old('name') )}}" autocomplete="off" required placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label"> Service Start Date </label>
                            <input type="date" class="form-control" id="date" name="start_date" value="{{ (isset($hospitalServiceDetail) ? $hospitalServiceDetail->start_date: old('start_date') )}}" autocomplete="off" placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Status</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="" {{ isset($hospitalServiceDetail) ? '':'selected'}} disabled>Select status</option>
                                <option value="1" {{ isset($hospitalServiceDetail) && ($hospitalServiceDetail->is_active ) == 1 ? 'selected': old('is_active') }}>Active</option>
                                <option value="0" {{ isset($hospitalServiceDetail) && ($hospitalServiceDetail->is_active ) == 0 ? 'selected': old('is_active') }}>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="png_class" class="form-label"> Service png Icon</label>
                            <input class="form-control" type="file" id="png_class" name="png_class" accept="image/png" >
                            @if(isset($hospitalServiceDetail) && $hospitalServiceDetail->image)
                                <img  src="{{asset(\App\Models\hospitalService::UPLOAD_PATH.$hospitalServiceDetail->png_class)}}"
                                      alt="" class="wd-100 mt-3" style="object-fit: contain">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="upload" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/png" >
                            @if(isset($hospitalServiceDetail) && $hospitalServiceDetail->image)
                                <img  src="{{asset(\App\Models\hospitalService::UPLOAD_PATH.$hospitalServiceDetail->image)}}"
                                      alt="" class="wd-100 mt-3" style="object-fit: contain">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">

                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short Description</label>
                            <textarea class="form-control" name="short_description" rows="6">{{ ( isset($hospitalServiceDetail) ? $hospitalServiceDetail->short_description: old('description') )}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description"  id="tinymceExample" rows="6">{{ ( isset($hospitalServiceDetail) ? $hospitalServiceDetail->description: old('description') )}}</textarea>
                        </div>
                    </div>


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{isset($hospitalServiceDetail) ? 'Update':'Create'}} </button>
                    </div>
                </div>


