@php use App\Models\Team; @endphp
<div class="row">
    <div class="col-lg-6">

        <div class="mb-3">
            <label for="name" class="form-label"> Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ (isset($teamDetails) ? $teamDetails->name: old('name') )}}"
                   autocomplete="off" required placeholder="">
        </div>
        <div class="mb-3">
            <label for="designation" class="form-label"> Designation</label>
            <input type="text" class="form-control" id="designation" name="designation"
                   value="{{ (isset($teamDetails) ? $teamDetails->designation: old('designation') )}}"
                   autocomplete="off" required placeholder="">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlSelect1" class="form-label">Status</label>
            <select class="form-select" id="is_active" name="is_active">
                <option value="" {{ isset($teamDetails) ? '':'selected'}} disabled>Select status</option>
                <option
                    value="1" {{ isset($teamDetails) && ($teamDetails->is_active ) == 1 ? 'selected': old('is_active') }}>
                    Active
                </option>
                <option value="0" {{ isset($teamDetails) && ($teamDetails->is_active ) == 0 ? 'selected': old('is_active') }}>
                    Inactive
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label for="upload" class="form-label">Upload Image</label>
            <input class="form-control" type="file" id="image" name="image">
            @if(isset($teamDetails) && $teamDetails->image)
                <img src="{{asset(Team::UPLOAD_PATH.$teamDetails->image)}}" alt="" width="150" height="150">
            @endif
        </div>
    </div>

    <div class="col-lg-6 mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="tinymceExample" rows="6">
            {{ ( isset($teamDetails) ? $teamDetails->description: old('description') )}}
        </textarea>
    </div>


    <div class="text-center">
        <button type="submit" class="btn btn-primary">
            <i class="link-icon" data-feather="plus"></i> {{isset($teamDetails) ? 'Update':'Create'}}
        </button>
    </div>
</div>


