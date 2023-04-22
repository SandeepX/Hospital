


                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="package_name" class="form-label">Package Name </label>
                            <input type="text" class="form-control" id="package_name" name="package_name"  value="{{ (isset($packageDetail) ? $packageDetail->package_name: old('package_name') )}}" autocomplete="off" required placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title </label>
                            <input type="text" class="form-control" id="title" name="title"  value="{{ (isset($packageDetail) ? $packageDetail->title: old('title') )}}" autocomplete="off"  placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="package_price" class="form-label">Package Price </label>
                            <input type="number" min="0" class="form-control" id="package_price" name="package_price"  value="{{ (isset($packageDetail) ? $packageDetail->package_price: old('package_price') )}}" autocomplete="off"  placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Status</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="" {{ isset($packageDetail) ? '':'selected'}} disabled>Select status</option>
                                <option value="1" {{ isset($packageDetail) && ($packageDetail->is_active ) == 1 ? 'selected': old('is_active') }}>Active</option>
                                <option value="0" {{ isset($packageDetail) && ($packageDetail->is_active ) == 0 ? 'selected': old('is_active') }}>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="upload" class="form-label">Package png Icon</label>
                            <input class="form-control" type="file" id="package_icon" name="package_icon" />

                            @if(isset($packageDetail) && $packageDetail->package_icon)
                                <img  src="{{asset(\App\Models\Package::UPLOAD_PATH.$packageDetail->package_icon)}}"
                                      alt="" class="wd-100 mt-3" style="object-fit: contain">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="upload" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="image" name="image" >
                            @if(isset($packageDetail) && $packageDetail->image)
                                <img  src="{{asset(\App\Models\Package::UPLOAD_PATH.$packageDetail->image)}}"
                                      alt="" class="wd-100 mt-3" style="object-fit: contain">
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="tinymceExample" rows="6">{{ ( isset($packageDetail) ? $packageDetail->description: old('description') )}}</textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{isset($packageDetail) ? 'Update':'Create'}} </button>
                    </div>
                </div>







