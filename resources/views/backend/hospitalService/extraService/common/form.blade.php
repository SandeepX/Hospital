<div class="row">
    <div class="col-lg-6">

        <div class="mb-3">
            <label for="name" class="form-label">Additional Service Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ (isset($extraServiceDetail) ? $extraServiceDetail->name: old('name') )}}" autocomplete="off" required placeholder="">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlSelect1" class="form-label">Status</label>
            <select class="form-select" id="is_active" name="is_active">
                <option value="" {{ isset($extraServiceDetail) ? '':'selected'}} disabled>Select status</option>
                <option value="1" {{ isset($extraServiceDetail) && ($extraServiceDetail->is_active ) == 1 ? 'selected': old('is_active') }}>Active</option>
                <option value="0" {{ isset($extraServiceDetail) && ($extraServiceDetail->is_active ) == 0 ? 'selected': old('is_active') }}>Inactive</option>
            </select>
        </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{isset($extraServiceDetail) ? 'Update':'Create'}} </button>
    </div>
</div>


