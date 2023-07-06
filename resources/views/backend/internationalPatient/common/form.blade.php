
<div class="row">
    <div class="col-lg-6">

        <div class="mb-3">
            <label for="name" class="form-label"> Patient Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ (isset($internationalPatientDetail) ? $internationalPatientDetail->name: old('name') )}}" autocomplete="off" required placeholder="">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlSelect1" class="form-label">Status</label>
            <select class="form-select" id="is_active" name="is_active">
                <option value="" {{ isset($internationalPatientDetail) ? '':'selected'}} disabled>Select status</option>
                <option value="1" {{ isset($internationalPatientDetail) && ($internationalPatientDetail->is_active ) == 1 ? 'selected': old('is_active') }}>Active</option>
                <option value="0" {{ isset($internationalPatientDetail) && ($internationalPatientDetail->is_active ) == 0 ? 'selected': old('is_active') }}>Inactive</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="upload" class="form-label">Upload Image</label>
            <input class="form-control" type="file" id="image" name="image" accept="image/png" >
            @if(isset($internationalPatientDetail) && $internationalPatientDetail->image)
                <img  src="{{asset(\App\Models\OurInternationalPatient::UPLOAD_PATH.$internationalPatientDetail->image)}}"
                      alt="" class="wd-100 mt-3" style="object-fit: contain">
            @endif
        </div>
    </div>

    <div class="col-lg-6 mb-3">
        <div class="mb-3">
            <label for="short_intro" class="form-label">Short Introduction</label>
            <textarea class="form-control" name="short_intro"  rows="3">{{ ( isset($internationalPatientDetail) ? $internationalPatientDetail->short_intro: old('short_intro') )}}</textarea>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description"  id="tinymceExample" rows="6">{{ ( isset($internationalPatientDetail) ? $internationalPatientDetail->description: old('description') )}}</textarea>
        </div>
    </div>


    <div class="text-center">
        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{isset($internationalPatientDetail) ? 'Update':'Create'}} </button>
    </div>
</div>


