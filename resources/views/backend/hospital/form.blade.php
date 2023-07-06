

<div class="row">
    <div class="col-lg-6 mb-3">
        <label for="name" class="form-label"> Hospital Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ ( $hospitalProfileDetail ? $hospitalProfileDetail->name: old('name') )}}" autocomplete="off" required placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ ($hospitalProfileDetail? $hospitalProfileDetail->email: old('email') )}}" autocomplete="off" required placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="address" class="form-label"> Address </label>
        <input type="text" class="form-control" id="address" name="address" value="{{ ($hospitalProfileDetail? $hospitalProfileDetail->address: old('address') )}}" autocomplete="off" required placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="" class="form-label">Phone One</label>
        <input type="text" class="form-control" id="phone_one" name="phone_one" value="{{ ($hospitalProfileDetail? $hospitalProfileDetail->phone_one: old('phone_one') )}}" autocomplete="off" required placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="number" class="form-label">Phone Two</label>
        <input type="number" class="form-control" id="phone_two" name="phone_two" value="{{ ($hospitalProfileDetail? $hospitalProfileDetail->phone_two: old('phone_two') )}}" autocomplete="off" placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="facebook_link" class="form-label"> Facebook link</label>
        <input type="url" class="form-control" id="facebook_link" name="facebook_link" value="{{ ($hospitalProfileDetail? $hospitalProfileDetail->facebook_link: old('facebook_link') )}}" autocomplete="off" placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="insta_link" class="form-label"> Instagram link</label>
        <input type="url" class="form-control" id="insta_link" name="insta_link" value="{{ ($hospitalProfileDetail? $hospitalProfileDetail->insta_link: old('insta_link') )}}" autocomplete="off" placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="twitter_link" class="form-label"> Twitter link</label>
        <input type="url" class="form-control" id="twitter_link" name="twitter_link" value="{{ ($hospitalProfileDetail? $hospitalProfileDetail->twitter_link: old('twitter_link') )}}" autocomplete="off" placeholder="">
    </div>


    <div class="col-lg-6 mb-3">
        <label for="website" class="form-label"> Website Url</label>
        <input type="url" class="form-control" id="website" name="website_url" value="{{ ($hospitalProfileDetail? $hospitalProfileDetail->website_url: old('website_url') )}}" autocomplete="off" placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="location_long" class="form-label"> location Longitude</label>
        <input type="text" class="form-control" id="location_long" name="location_long" value="{{ ($hospitalProfileDetail? $hospitalProfileDetail->location_long: old('location_long') )}}" autocomplete="off" placeholder="Enter Location Longitude">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="location_lat" class="form-label"> location Latitude</label>
        <input type="text" class="form-control" id="location_lat" name="location_lat" value="{{ ($hospitalProfileDetail? $hospitalProfileDetail->location_lat: old('location_lat') )}}" autocomplete="off" placeholder="Enter Location Latitude">
    </div>

    <div class="col-lg-12 mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="tinymceExample" rows="6">{{ ( isset($hospitalProfileDetail) ? $hospitalProfileDetail->description: old('description') )}}</textarea>
    </div>

    <div class="col-lg-12 mb-3">
        <label for="marquee_content" class="form-label">Marquee Content</label>
        <textarea class="form-control" name="marquee_content" id="tinymceExample"  rows="6">{{ ( isset($hospitalProfileDetail) ? $hospitalProfileDetail->marquee_content: old('marquee_content') )}}</textarea>
    </div>

    <div class="col-lg-6 mb-3">
        <label for="upload" class="form-label">Upload Logo</label>
        <input class="form-control" type="file" id="upload" name="logo" >
        @if(($hospitalProfileDetail && $hospitalProfileDetail->logo))
            <img  src="{{asset(\App\Models\HospitalProfile::UPLOAD_PATH.$hospitalProfileDetail->logo)}}"
                  alt="" class="wd-200  ht-100 mt-3" style="object-fit: contain">
        @endif
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{$hospitalProfileDetail? 'Update':'Save'}} </button>
    </div>
</div>
