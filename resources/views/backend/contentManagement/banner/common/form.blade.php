


                <div class="row">
                    <div class="col-lg-6">

                        <div class="mb-3">
                            <label for="banner_type" class="form-label">Banner Type</label>
                            <select class="form-select" id="banner_type" name="banner_type"  required>
                                <option value="" {{isset($bannerDetail) ? '' : 'selected'}}  disabled>Select Banner Type</option>
                                @foreach(\App\Models\Banner::BANNER_TYPE as $value)
                                    <option value="{{$value}}" {{ isset($bannerDetail) && ($bannerDetail->banner_type ) || old('banner_type') == $value ? 'selected': '' }}>
                                        {{str_replace('_',' ',$value)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label"> Title</label>
                            <input type="text" class="form-control" id="title" maxlength="150" name="title" value="{{ (isset($bannerDetail) ? $bannerDetail->title: old('title') )}}" autocomplete="off"  placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="sub_title" class="form-label"> Sub Title </label>
                            <input type="text" class="form-control" id="sub_title" maxlength="70" name="sub_title" value="{{ (isset($bannerDetail) ? $bannerDetail->sub_title: old('sub_title') )}}" autocomplete="off"  placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Status</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="" {{ isset($bannerDetail) ? '':'selected'}} disabled>Select status</option>
                                <option value="1" {{ isset($bannerDetail) && ($bannerDetail->is_active ) || old('is_active') == 1 ? 'selected': '' }}>Active</option>
                                <option value="0" {{ isset($bannerDetail) && ($bannerDetail->is_active ) || old('is_active') == 0 ? 'selected': '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="upload" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="image" name="image"  >
                            @if(isset($bannerDetail) && $bannerDetail->image)
                                <img  src="{{asset(\App\Models\Banner::UPLOAD_PATH.$bannerDetail->image)}}"
                                      alt="" width="150"
                                      height="150">
                            @endif
                        </div>
                    </div>



                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{isset($bannerDetail) ? 'Update':'Create'}} </button>
                    </div>
                </div>



