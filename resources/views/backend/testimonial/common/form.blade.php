

                <div class="row">
                    <div class="col-lg-6">

                        <div class="mb-3">
                            <label for="name" class="form-label">Testimonial By </label>
                            <input type="text" class="form-control" id="name" name="name"  value="{{ (isset($testimonialDetails) ? $testimonialDetails->name: old('name') )}}" autocomplete="off" required placeholder="">
                        </div>

                        <div class="mb-3">
                            <label for="post" class="form-label">Post </label>
                            <input type="text" class="form-control" id="post" name="post"  value="{{ (isset($testimonialDetails) ? $testimonialDetails->post: old('post') )}}" autocomplete="off"  placeholder="">
                        </div>


                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Is Publish</label>
                            <select class="form-select" id="is_published" name="is_published">
                                <option value="" {{ isset($testimonialDetails) ? '':'selected'}} disabled>Select status</option>
                                <option value="1" {{ isset($testimonialDetails) && ($testimonialDetails->is_published ) == 1 ? 'selected': old('is_published') }}>Yes</option>
                                <option value="0" {{ isset($testimonialDetails) && ($testimonialDetails->is_published ) == 0 ? 'selected': old('is_published') }}>No</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="rating" value="1" {{ isset($testimonialDetails) && ($testimonialDetails->rating=="1") || old('rating')? "checked" : '' }} class="form-check-input" id="one">
                                    <label class="form-check-label" for="rating1">
                                        1
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="rating" value="2" {{ isset($testimonialDetails) && ($testimonialDetails->rating=="2") || old('rating')? "checked" : '' }} class="form-check-input" id="two">
                                    <label class="form-check-label" for="rating2">
                                        2
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="rating" value="3" {{ isset($testimonialDetails) && ($testimonialDetails->rating=="3") || old('rating') ? "checked" : ''}} class="form-check-input" id="three">
                                    <label class="form-check-label" for="rating3">
                                        3
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="rating" value="4" {{ isset($testimonialDetails) && ($testimonialDetails->rating=="4") || old('rating')? "checked" : '' }} class="form-check-input" id="four">
                                    <label class="form-check-label" for="rating4">
                                        4
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="rating" value="5" {{ isset($testimonialDetails) && ($testimonialDetails->rating=="5") || old('rating') ? "checked" : '' }} class="form-check-input" id="five">
                                    <label class="form-check-label" for="rating5">
                                        5
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="upload" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="image" name="image" >
                            @if(isset($testimonialDetails) && $testimonialDetails->image)
                                <img  src="{{asset(\App\Models\Testimonial::UPLOAD_PATH.$testimonialDetails->image)}}"
                                      alt="" class=" wd-100 mt-3" style="object-fit: contain">
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="tinymceExample" rows="6">{{ ( isset($testimonialDetails) ? $testimonialDetails->description: old('description') )}}</textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{isset($testimonialDetails) ? 'Update':'Create'}} </button>
                    </div>
                </div>


